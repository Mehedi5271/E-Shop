<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class,'home'])->name('home');
Route::get('/users', [HomeController::class,'users'])->name('users');
