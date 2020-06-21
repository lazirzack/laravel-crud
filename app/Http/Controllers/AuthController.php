<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            //dd($request->all());
            return redirect('/dashboard');
        }
        
        return redirect('/login')->with('error','Email atau password salah');

    }

    public function postRegister(Request $request) {
        $username = $request['username'];
        $email = $request['email'];
        $password = bcrypt($request['password']);

        $user = new \App\User();
        $user->email = $email;
        $user->username = $username;
        $user->password = $password;

        $user->save();

        return redirect()->route('login');        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
