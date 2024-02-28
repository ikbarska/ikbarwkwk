<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index() {
        return view('login');
    }
    function login(Request $request) {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email required!',
            'password.required'=>'Password required!'
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($infologin)){
         if(Auth::user()->role == 'admin'){
              return redirect('buku');
         } else if (Auth::user()->role == 'petugas') {
            return redirect('');
         } else if (Auth::user()->role == 'peminjam') {
            return redirect('peminjam');
         }
        } else {
            return redirect('')->withErrors('Incorrect username/password')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}
