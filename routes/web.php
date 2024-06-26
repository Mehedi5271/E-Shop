<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'welcome'])->name('welcome');

// Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function(){
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/products/trash',[ProductController::class,'trash'])->name('products.trash');
        Route::patch('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::delete('/products/{id}/delete', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/products/downloadPdf',[ProductController::class,'downloadPdf'])->name('products.downloadPdf');
        Route::get('/products/downloadExcel',[ProductController::class,'downloadExcel'])->name('products.downloadExcel');

        Route::post('/add-to-cart', [CartController::class,'store'])->name('cart.store');
        Route::get('/cart-products', [CartController::class,'index'])->name('cart.products');
        Route::delete('cart-products/{id}',[CartController::class,'deleteIteam']);
    });





    require __DIR__.'/auth.php';




    Route::middleware('auth')->prefix('admin')->group(function(){



        Route::get('/products',[ProductController::class,'index'])->name('products.index');
        Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
        Route::post('/products',[ProductController::class,'store'])->name('products.store');
        Route::get('/products/{id}',[ProductController::class,'show'])->name('products.show');
        Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');
        Route::patch('/products/{id}',[ProductController::class,'update'])->name('products.update');
        Route::delete('/products/{id}',[ProductController::class,'destroy'])->name('products.destroy');
        Route::post('orders',[OrderController::class,'store'])->name('orders.store');
        Route::get('orders/{id}',[OrderController::class,'show'])->name('orders.show');
        Route::get('orders-success',[OrderController::class,'confirmed'])->name('orders.confirmed');





        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

    });

    Route::get('/{slug}',[HomeController::class,'CategoryWiseProducts'])->name('category.products');
    Route::get('/products/{slug}',[HomeController::class,'productDetails'])->name('product.details');




