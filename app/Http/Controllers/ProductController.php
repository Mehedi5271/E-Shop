<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function products(){
       $products = Product::latest()->paginate();
        return view('admin.pages.products',compact('products'));
    }

    function create(){
        return view('admin.pages.create');
    }

    function store(ProductRequest $request){

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'is_active' => $request->is_active ?? 0

        ]);


        return redirect()->route('products.index')->withStatus('Data Insert Sucessfully');
    }

    public function edit($id){
       $products = Product::findOrFail($id);
       return view('admin.pages.edit',compact('products'));

    }
}
