<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/checkout', [PaymentController::class,'checkout']);
 */
Route::get('/checkout-page', function () {
    return view('checkout');
});

Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');