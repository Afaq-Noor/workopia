<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function login() {
        
        return view('auth.login') ;
    }


     public function authenticate(Request $request)   {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100' ,
            'password' => 'required' ,
        ]) ;

        if(Auth::attempt($credentials)) {
             // Regenerate the session to prevent fixation attacks 
             $request->session()->regenerate() ;

             return redirect()->intended(route('home'))->with('success', 'You are now loggin in!') ; 
        }

        // if auth fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email') ;
      }

      public function logout(Request $request) {
        Auth::logout() ;

       $request->session()->invalidate() ;
       $request->session()->regenerateToken() ;

       return redirect('/') ;
      }
}
