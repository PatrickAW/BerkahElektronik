<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout()
    {
        return view('payment.checkout');
    }
    
    public function history()
    {
        return view('payment.history');
    }
}