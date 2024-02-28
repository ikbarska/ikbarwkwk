<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index(){
        echo"Halo, selamat datang";
        echo"<h1>". Auth::user()->name . "</h1>";
        echo"<a href='/logout'>Logout</a>";
    }
    function admin(){
        echo"Wellcome, Admin";
        echo"<h1>". Auth::user()->name . "</h1>";
        echo"<a href='/logout'>Logout</a>";
    }
    function petugas(){
        echo"Wellcome, petugas";
        echo"<h1>". Auth::user()->name . "</h1>";
        echo"<a href='/logout'>Logout</a>";
    }
    function peminjam(){
        echo"Wellcome, peminjam";
        echo"<h1>". Auth::user()->name . "</h1>";
        echo"<a href='/logout'>Logout</a>";
    }
}
