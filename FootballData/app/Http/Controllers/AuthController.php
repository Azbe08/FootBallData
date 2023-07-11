<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(){
        return view("login");
    }

    function register(){
        return view("register");
    }

    function loginUser(Request $request)
    {
        $request->validate([
            'email'=>'required','email',
            'password'=>'required',
        ]);

        $credentials=$request->only('email','password');
        if(!Auth::attemp($credentials)){
            $err=[
                "err"=>"wrong password u fat fuck"
            ];
            return view("login",$err);
        }
        return view("welcome");
    }

    function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);

        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $user=User::create($data);
        $model=array();
        if(!$user){
            $model=[
                "err"=>"u messed up fatty",
            ];
            return view("register",$model);
        }else{
            return view("login");
        }



    }
}
