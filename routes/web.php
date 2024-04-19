<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('/products',[ProductController::class,'products'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::get('/home', [HomeController::class,'home'])->name('home');
Route::get('/users', [HomeController::class,'users'])->name('users');
