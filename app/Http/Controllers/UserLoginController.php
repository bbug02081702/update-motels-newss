<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserLoginController extends Controller
{
    public function loginUser(){
        return view('user.home.index');
    }

    public function loginProsesUser(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return \redirect('user/home/info');
        }

        return \redirect('');
    }

    public function registerUser(){
        return view('user.home.dangky');
    }

    public function registerUserStore(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);
        //  dd($user);
        return \redirect('');
    }

    public function logoutUser(){
        Auth::logout();
        return \redirect('/');
    }
}
