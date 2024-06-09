<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $categories = Category::pluck('title','slug')->toArray();

        return view('cart-products',compact('categories'));

    }
    public function store(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $cartProduct = CartProduct::where('user_id', auth()->user()->id)
            ->where('product_id', $productId)
            ->where('color_id', $request->color_id)
            ->first();

        if ($cartProduct) {
            $quantity += $cartProduct->quantity;
            $cartProduct->update(['quantity' => $quantity]);
        } else {
            CartProduct::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'color_id' => $request->color_id,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function deleteIteam($id){
       try{
        CartProduct::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Iteam Remove from Cart'
        ]);
       } catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' =>$e->getMessage()
        ]);

       }
    }
}
