<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'welcome'])->name('welcome');
Route::get('/{id}',[HomeController::class,'CategoryWiseProducts'])->name('category.products');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->prefix('admin')->group(function(){
Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::get('/products/trash',[ProductController::class,'trash'])->name('products.trash');
Route::patch('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
Route::delete('/products/{id}/delete', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/products/downloadPdf',[ProductController::class,'downloadPdf'])->name('products.downloadPdf');
Route::get('/products/downloadExcel',[ProductController::class,'downloadExcel'])->name('products.downloadExcel');

Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products',[ProductController::class,'store'])->name('products.store');
Route::get('/products/{id}',[ProductController::class,'show'])->name('products.show');
Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');
Route::patch('/products/{id}',[ProductController::class,'update'])->name('products.update');
Route::delete('/products/{id}',[ProductController::class,'destroy'])->name('products.destroy');

Route::get('/users',[UserController::class,'index'])->name('users.index');
});


