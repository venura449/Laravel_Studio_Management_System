<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $user = Auth::user();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $outstanding = Order::sum('amount_due');
        $statusCounts = [
            'Placed' => Order::where('state', 'Placed')->count(),
            'Designed' => Order::where('state', 'Designed')->count(),
            'Ready' => Order::where('state', 'Ready')->count(),
            'Canceled' => Order::where('state', 'Canceled')->count(),
            'Failed' => Order::where('state', 'Failed')->count(),
        ];
        if ($user && $user->role === 'designer') {
            $orders = Order::where('state', 'Placed')->latest()->take(5)->get();
        } else {
            $orders = Order::latest()->take(5)->get();
        }
        return view('home', compact('users', 'orders', 'totalOrders', 'totalRevenue', 'outstanding', 'statusCounts'));
    }

}
