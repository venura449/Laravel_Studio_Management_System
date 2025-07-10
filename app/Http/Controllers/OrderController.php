<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('Order.addorder');
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'company_name'        => $request->company_name,
            'company_address'     => $request->company_address,
            'company_mobile'      => $request->company_mobile,
            'representer_name'    => $request->representer_name,
            'representer_mobile'  => $request->representer_mobile,
            'designer_id'         => $request->designer_id,
            'printer_id'          => $request->printer_id,
            'services'            => $request->services,
            'items'               => $request->items,
            'payment_method'      => $request->payment_method,
            'total_price'         => $request->total_price,
            'amount_paid'         => $request->amount_paid,
            'discount'            => $request->discount,
            'amount_due'          => $request->amount_due,
            'remarks'             => $request->remarks,
        ]);

        return redirect()->back()->with('success', 'Order created successfully!');
    }

    public function view() {
        $auth = strtolower(auth()->user()->getrole()); // normalize role
        $ordersQuery = Order::query(); // start with base query

        // Exclude orders with state 'unpaid' or 'paid'
        $ordersQuery->whereNotIn('state', ['unpaid', 'paid']);

        // Apply role-specific filters
        if ($auth === 'printer') {
            $ordersQuery->where('state', 'designed');
        } elseif ($auth === 'designer') {
            $ordersQuery->where('state', 'placed');
        }
        // Admin or others see all remaining orders (already filtered above)

        $orders = $ordersQuery->get(); // execute query
        return view('Order.manageorder', compact('orders'));
    }



    public function vieweach($id) {
        $order = Order::findorFail($id);
        $items = json_decode($order->items, true);
        return view('Order.vieworder', compact('order','items'));
    }

    public function delete($id){
        Order::findorFail($id)->delete();
        return redirect()->route('order.view')->with('success', 'Order deleted successfully!');
    }

    public function updateform($id){
        $order=Order::findorFail($id);
        return view('Order.editorder', compact('order'));
    }

    public function update(Request $request, $id){
        try{
            Order::findorFail($id)->update($request->all());
        }
        catch(Exception $e){
            return redirect()->route('order.view')->with('error', $e->getMessage());
        }
        return redirect()->route('order.view')->with('success', 'Order updated successfully!');
    }

    public function renderfinalpay(){
        $ordersQuery = Order::query()->where('state','Ready'); // start with base query
        $orders = $ordersQuery->get(); // execute query
        return view('Payment.viewpay', compact('orders'));
    }

    public function printBill($id) {
        $order = Order::findorFail($id);
        $items = json_decode($order->items, true);
        return view('Order.printbill', compact('order', 'items'));
    }

    public function changepay($id){
        try{
            Order::findorFail($id)->update(['state'=>'paid']);
        }
        catch(Exception $e){
            return redirect()->route('pay.view')->with('error', $e->getMessage());
        }
        return  redirect()->route('pay.view')->with('success', 'Payment  updated successfully!');
    }
    public function changeunpaid($id){
        try{
            Order::findorFail($id)->update(['state'=>'unpaid']);
        }
        catch(Exception $e){
            return redirect()->route('pay.view')->with('error', $e->getMessage());
        }
        return  redirect()->route('pay.view')->with('success', 'Payment  updated successfully!');
    }

    public function unpaidView(){
        try{
            $ordersQuery = Order::query()->where('state','Unpaid');
            $orders = $ordersQuery->get();
        }
        catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('Payment.unpaid', compact('orders'));
    }

    public function paidView(){
        try{
            $ordersQuery = Order::query()->where('state','paid');
            $orders = $ordersQuery->get();
        }
        catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('Payment.paid', compact('orders'));
    }

    public function paid($id){
        try{
            Order::findorFail($id)->update(['state'=>'paid']);
        }
        catch(Exception $e){
            return redirect()->route('pay.unpaidview')->with('error', $e->getMessage());
        }
        return  redirect()->route('pay.unpaidview')->with('success', 'Payment  updated successfully!');
    }

    public function realpay($id){
        try{
            Order::findorFail($id)->update(['state'=>'paid']);
        }
        catch(Exception $e){
            return redirect()->route('order.view')->with('error', $e->getMessage());
        }
        return  redirect()->route('order.view')->with('success', 'Payment  updated successfully!');
    }

    public function laterpay($id){
        try{
            Order::findorFail($id)->update(['state'=>'unpaid']);
        }
        catch(Exception $e){
            return redirect()->route('order.view')->with('error', $e->getMessage());
        }
        return  redirect()->route('order.view')->with('success', 'Payment  updated successfully!');
    }

}
