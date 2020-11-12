<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class CheckoutController extends Controller
{
    // Has to be logged in checkout
    public function __construct(){
        $this->middleware('auth');
    }

    // Displays the checkout form
    public function ShowCheckoutForm(){
        return view('checkout/order-details');
    }

    // handles the checkout submission
    public function SubmitCheckout(Request $request){
        // get the basket
        $basket = session()->get('basket');

        // check items have enough stock for the sale
        // update quantities as well
        foreach ($basket as $basketItem){
            // check if current item is the basket total
            if (is_float($basketItem)){
                continue;
            }

            // find the product needing updated
            $productToUpdate = Product::find($basketItem['productId']);

            // check the stock on the product to ensure the user can purchase their desired quantity
            if ($productToUpdate->stock >= $basketItem['quantity']){
                $productToUpdate->stock -= $basketItem['quantity']; // remove quantity from stock
                $productToUpdate->save();
            }
            else {
                // if there is not enough stock, redirect to home page with error
                return redirect('/')->with('error', 'Unable to process your request - There is not enough "'.$productToUpdate->name.'" in stock. Please remove from your basket or reduce the quantity to continue to payment');
            }
        }

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
        $order->products = $basket;
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

        

        // remove items from the basket
        session()->forget('basket');

        return view("/checkout/confirm-order")->with("values", $passthrough);
    }
}
