<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $items = Items::all();
        return view('Items.manageitems',compact('items'));
    }


    public function delete($id){
     try{
         Items::findorFail($id)->delete();
     }
     catch(Exception $e){
         return redirect()->route('item.view')->with('error','Internal Server Error'.$e->getMessage());
     }
        return redirect()->route('item.view')->with('success','Item Deleted Successfully');
    }

    public function edit(Request $request,$id){
        try{
            Items::findorFail($id)->update($request->all());
        }
        catch(Exception $e){
            return redirect()->route('item.view')->with('error','Internal Server Error'.$e->getMessage());
        }
        return redirect()->route('item.view')->with('success','Item Updated Successfully');
    }

    public function vieweach($id){
      try{
          $item = Items::findorFail($id);
      }
      catch(Exception $e){
          return back()->with('error','Internal Server Error'.$e->getMessage());
      }
        return view('Items.itemsedit',compact('item'));
    }

    public function create(){
        return view('Items.additems');
    }

    public function store(Request $request){
        try{
            Items::create($request->all());
        }
        catch(Exception $e){
            return back()->with('error','Internal Server Error'.$e->getMessage());
        }
        return redirect()->route('item.create')->with('success','Item Created Successfully');
    }

    public function getAllJson() {
        $items = Items::all(['id', 'item', 'unit_price']);
        return response()->json($items);
    }
}
