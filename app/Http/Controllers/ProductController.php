<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function index(){
       $products = Product::latest()->paginate();
        return view('admin.pages.products',compact('products'));
    }

    public function show($id){
        $products = Product::findOrFail($id);

        return view('admin.pages.show',compact('products'));


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

    function update(ProductUpdateRequest $request, $id){
        $products = Product::findOrFail($id);

        $products->update([
            'title' => $request->title,
            'price' => $request->price,
           'description' => $request->description,
            'is_active' => $request->is_active ?? 0
        ]);

        return redirect()->route('products.index')->withStatus('Data Update Sucessfully');
    }

    public function destroy($id){
        Product::destroy($id);
        return redirect()->route('products.index')->withStatus('Data Deleted Sucessfully');


    }
}
