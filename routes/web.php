<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth')->name('redirect');

Route::middleware('admin')->group(function () {

    Route::post('/resolve_category', [AdminController::class, 'resolve_category']);
    Route::get('/view_category', [AdminController::class, 'view_category']);
    Route::delete('/category/{category}', [AdminController::class, 'destroy'])->name('category.destroy');
    Route::get('/view_product', [AdminController::class, 'view_product'])->name('view_product');
    Route::post('/add_product', [AdminController::class, 'add_product'])->name('add_product');
    Route::get('/show_product', [AdminController::class, 'show_product'])->name('show.product');
    Route::delete('/product/{product}', [AdminController::class, 'destroy_product'])->name('product.destroy');

    Route::get('/product/edit/{product}',[AdminController::class,'edit'])->name('product.edit');
    Route::put('/product/update/{product}',[AdminController::class,'update'])->name('product.update');


});










