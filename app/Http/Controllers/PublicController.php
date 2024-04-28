<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('/components/partials/navbar',compact('categories'));
    }
}
