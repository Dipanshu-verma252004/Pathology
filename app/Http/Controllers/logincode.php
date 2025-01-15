<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class loginCode extends Controller
{
    function login(Request $request){
        $validate=$request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // $credentials = $request->only('email', 'password');
        $credentials = ['email' => $request->email,
                        'password' => $request->password
                    ];
        $credentials=$request->only('email','password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        else{
            return redirect()->route('login')->with('error',"Invalid Credentials!");
        }

        // if (Auth::attempt($credentials)) {
        //     return redirect()->route('home');
        //     } else {
        //         return redirect()->back()->withErrors(['Invalid credentials']);
        //         }
    }
   
}