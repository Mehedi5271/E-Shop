<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;




class ProductController extends Controller
{
    // All Show Data
    public function index(){
       $products = Product::latest()->paginate(10);
        return view('admin.pages.products',compact('products'));
    }

    // Individual Data Show
    public function show($id){
        $products = Product::findOrFail($id);

        return view('admin.pages.show',compact('products'));

    }

    // Insert Data
    public function create(){
        $categories = Category::pluck('title','id')->toArray();
        $colors = Color::pluck('name','id')->toArray();
        return view('admin.pages.create',compact('categories','colors'));
    }


   public function store(ProductRequest $request){


        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/images', $imageName);         // Store in Storage Folder

        // Public Folder
        // $request->image->move(public_path('images'), $imageName);

       $products = Product::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'description' => $request->description,
            'is_active' => $request->is_active ?? 0,
            'image'=> $imageName

        ]);

        $products->colors()->attach($request->color_id);

        return redirect()->route('products.index')->withStatus('Data Insert Sucessfully');
    }

    // Insert Data End

    // Edit Data
    public function edit($id){
        $products = Product::findOrFail($id);
        $categories = Category::pluck('title','id')->toArray();
        $colors = Color::pluck('name','id')->toArray();
        $selectedColors = $products->colors()->pluck('id')->toArray();
        $selectedCategory = $products->category_id;

        return view('admin.pages.edit',compact('products','categories','colors','selectedColors','selectedCategory'));

    }

    // Update Data
    public function update(ProductUpdateRequest $request, $id){
        $products = Product::findOrFail($id);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
        }



        $products->update([
            'category_id' => $request->category_id,

            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
           'description' => $request->description,
            'is_active' => $request->is_active ?? 0,
            'image'=> $imageName ?? $products->image

        ]);

        $products->colors()->sync($request->color_id);


        return redirect()->route('products.index')->withStatus('Data Update Sucessfully');
    }

    //Soft Delete
    public function destroy($id){
        Product::destroy($id);


        return redirect()->route('products.index')->withStatus('Data Deleted Sucessfully');
    }

    // Trash Data
    public function trash(){


    $products = Product::latest()->onlyTrashed()->paginate();

    return view('admin.pages.trash', compact('products'));
    }
    //Store Data
    public function restore($id){
    $product = Product::onlyTrashed()->find($id);
    $product-> restore();
    return redirect()->route('products.trash')->withStatus('Data Restore Sucessfully');


    }

     // Final Delete
     public function delete($id){
        $product = Product::onlyTrashed()->find($id);
        $product->colors()->detach();
        $product-> forceDelete();

        return redirect()->route('products.trash')->withStatus('Data Deleted Sucessfully');
    }

    //  PDF Download
    public function downloadPdf(){
        $products = Product::latest()->take(10)->get();
        $pdf = Pdf::loadView('admin.pages.pdf', compact('products'));
    return $pdf->download('product-list.pdf');
    }

        //  Excel Download

    public function downloadExcel()
    {
        return Excel::download(new ProductsExport, 'product-list.xlsx');
    }








}
