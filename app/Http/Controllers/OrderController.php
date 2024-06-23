<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Notifications\OrderConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request){
        DB::beginTransaction(); // multiple table a data pathanor kaj korar jonno use kora hoy
        // Create a new order for the authenticated user
        $order = auth()->user()->orders()->create([
            'contact_number' => $request->contact_number,
            'shipping_address' => $request->shipping_address,
        ]);

        // Ensure products is an array
        $products = $request->products ?? [];

        foreach ($products as $item) {
            // Find the cart product by ID
            $cartProduct = CartProduct::where('id', $item['cart_product_id'])->first();

            if (!$cartProduct) {
                continue; // Skip if the cart product is not found
            }

            // Get the product and color
            $product = $cartProduct->product;
            $color = $cartProduct->color;

            // Create the order product
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_title' => $product->title, // Corrected this line
                'unit_price' => $product->price,
                'quantity' => $item['quantity'],
                'color_id' => $color ? $color->id : null, // Check if color is null
                'color_name' => $color ? $color->name : null, // Check if color is null
            ]);
        }

        // Delete all cart products for the authenticated user
        auth()->user()->cartProducts()->delete();

       $notifiableUser = User::where('role_id',1)->get();
       foreach($notifiableUser as $user){

           $user->notify(new OrderConfirmed($order));
       }



        DB::commit();
        return redirect()->route('orders.confirmed');
    }

    public function show($id){
        $order = Order::findOrFail($id);

        $notificaton = auth()->user()->unreadNotifications()->where('id',request('notification_id'))->first();
        if($notificaton){

            $notificaton->markAsRead();
        }
        return view('admin.pages.orders.show',compact('order'));
    }

    public function confirmed(){
        $categories = Category::pluck('title','slug')->toArray();

        return view('order-confirmed',compact('categories'));
    }
}
