<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(){
        $products = Product::latest()->paginate(12);
        $categories = Category::pluck('title','id')->toArray();

        return view('welcome',compact('products','categories'));
    }

    public function CategoryWiseProducts($categoryId)
    {
        $products = Product::latest()->paginate(12);
        $categories = Category::pluck('title','id')->toArray();

        return view('welcome',compact('products','categories'));
    }




    function home(){
        return view('home');
    }

    function users(){
        $users = User::all();
        return view('user',compact('users'));
    }
}
