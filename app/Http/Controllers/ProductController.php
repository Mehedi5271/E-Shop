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

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/images', $imageName);         // Store in Storage Folder

        // Public Folder
        // $request->image->move(public_path('images'), $imageName);

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'is_active' => $request->is_active ?? 0,
            'image'=> $imageName

        ]);

        return redirect()->route('products.index')->withStatus('Data Insert Sucessfully');
    }

    public function edit($id){
       $products = Product::findOrFail($id);
       return view('admin.pages.edit',compact('products'));

    }

    function update(ProductUpdateRequest $request, $id){
        $products = Product::findOrFail($id);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
        }



        $products->update([
            'title' => $request->title,
            'price' => $request->price,
           'description' => $request->description,
            'is_active' => $request->is_active ?? 0,
            'image'=> $imageName ?? $products->image

        ]);

        return redirect()->route('products.index')->withStatus('Data Update Sucessfully');
    }

    //Soft Delete
    public function destroy($id){
        Product::destroy($id);

        return redirect()->route('products.index')->withStatus('Data Deleted Sucessfully');
    }


    public function trash(){
    $products = Product::latest()->onlyTrashed()->paginate();

    return view('admin.pages.trash', compact('products'));
    }

    public function restore($id){
    $product = Product::onlyTrashed()->find($id);
    $product-> restore();
    return redirect()->route('products.trash')->withStatus('Data Restore Sucessfully');


    }





}
