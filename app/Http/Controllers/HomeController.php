<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(){
        return view('home');
    }

    function users(){
        $users = User::all();
        return view('user',compact('users'));
    }
}
