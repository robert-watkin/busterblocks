<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    function ShowCheckoutForm(){
        return view('checkout/order-details');
    }

    function SubmitCheckout(Result $results){
        return true;
    }
}
