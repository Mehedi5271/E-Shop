<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function products(){
       $products = Product::all();
        return view('admin.pages.products',compact('products'));
    }

    function create(){
        return view('admin.pages.create');
    }
}
