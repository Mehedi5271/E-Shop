<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function products(){
        return view('admin.pages.products');
    }

    function create(){
        return view('admin.pages.create');
    }
}
