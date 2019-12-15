<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class PaymentConfirmationController extends Controller
{
    public function index()
    {
        if (!session()->has('success_message')) {
            return redirect('/');
        }

        return view('layouts.thankyou');
    }
}
