<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        if(Auth::check())
            return redirect()->route('admin');
        else
            return view('login');
    }

    public function login(Request $request){
        $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]))
            return redirect()->route('admin');
        else
            return back()->with('loginError', 'Email or password are not match');
    }
}
