<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function ShowCheckoutForm(){
        return view('checkout/order-details');
    }

    public function SubmitCheckout(Request $request){
        // validate form input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'addressLine1' => 'required',
            'addressLine2' => 'nullable',
            'city' => 'required',
            'postCode' => 'required'
        ]);

        // create new order
        $order = new Order;

        // populate with values from the request
        $order->products = session()->get('basket');
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address_line_1 = $request->addressLine1;
        $order->address_line_2 = $request->addressLine2;
        $order->city = $request->city;
        $order->post_code = $request->postCode;

        // save order to database
        $order->save();

        $passthrough = [
            "success" => "Your order (ID: ".$order->id.") has been placed successfully!",
            "order" => $order
        ];

        return view("/checkout/confirm-order")->with("values", $passthrough);
    }
}
