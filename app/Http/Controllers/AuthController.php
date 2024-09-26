<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return view('Auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:4',
            'confirm_password'=>'required|same:password'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role_id'=>1
        ]);
        return redirect('/');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:4'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            if(Auth::user()->is_verified==0){
                Session::flush();
                return redirect('/')->with(['message'=>'Please contact to Super Admin to verify']);
            }else{
                Session::put('email',$request->email);
                return redirect('admin/user');
            }
        }else{
            return redirect('/')->with(['message'=>'Invalid Login Crediantials']);
        }
    }
}
