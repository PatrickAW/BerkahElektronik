<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get('/beranda', function () {
    return view('customers.dashboard.index');
});

Route::resource('products', ProductController::class);
