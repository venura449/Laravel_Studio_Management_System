<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = User::all();
        return view('User.manage',compact('data'));
    }
    public function update($userId,Request $request){
        try{
            User::findorFail($userId)->update($request->all());
        }
        catch(Exception $e){
            return redirect()->route('user.manage')->with('error',$e->getMessage());
        }
        return redirect()->route('user.manage')->with('success','User updated successfully');
    }

    public function delete($userId){
       try{
           User::findorFail($userId)->delete();
       }
       catch(Exception $e){
           return redirect()->route('user.manage')->with('error',$e->getMessage());
       }
        return redirect()->route('user.manage')->with('success','User Deleted successfully');
    }
}
