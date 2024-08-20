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

    Route::get('/orders',[AdminController::class,'orders'])->name('orders.show');
    Route::get('/order/edit/{order}',[AdminController::class,'edit_order'])->name('order.edit');
    Route::put('/order/update/{order}',[AdminController::class,'update_order'])->name('order.update');
    Route::delete('/delete/orders_all',[AdminController::class,'all_orders_delete'])->name('orders.deleteAll');

    Route::get('/order/download/{order}',[AdminController::class,'download_pdf'])->name('order.pdf');


    Route::delete('/order/delete/{order}',[AdminController::class,'delete_order'])->name('order.delete');
    Route::put('/order/accept/{order}',[AdminController::class,'accept_order']);

});
Route::get('/product_details/{product}',[HomeController::class,'product_details'])->name('product.details');
Route::get('/all_products',[HomeController::class,'all_products'])->name('all.products');


Route::post('/add_to_cart/{product}',[HomeController::class,'add_to_cart'])->name('product.cart');
Route::get('/show_cart',[HomeController::class,'show_cart'])->name('show.cart');
Route::delete('/delete_from_cart/{cart}',[HomeController::class,'delete_cart'])->name('delete.cart');

Route::post('/cash/{total_price}',[HomeController::class,'cashpay'])->name('cash.cart');

Route::get('/stripe/{total_price}',[HomeController::class,'stripe'])->name('stripe.cart');

Route::post('stripes/{total_price}',[HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/show_orders',[HomeController::class,'show_orders']);
Route::put('/cancel_order/{order}',[HomeController::class,'cancel_order']);



















