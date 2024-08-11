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
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/resolve_category', [AdminController::class, 'resolve_category'])->name('resolve_category');
Route::get('/category/{category}', [AdminController::class, 'destroy'])->name('category.destroy');
Route::get('/view_product', [AdminController::class, 'view_product'])->name('view_product');

Route::post('/add_product', [AdminController::class, 'add_product'])->name('add_product');






