<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    redirect('/products');
});

Route::resource('products', ProductController::class);