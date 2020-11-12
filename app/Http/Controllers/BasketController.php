<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BasketController extends Controller
{
    

    public function Index(){
        $basket = session()->get('basket');

        return view('pages.basket')->with('basket', $basket);
    }

    //
    // Handles adding products to the basket
    //
    public function AddToBasket($id){
        // find the product with the given id
        $product = Product::find($id);

        // check if the product exists
        if (!$product){
            return redirect('/')->with('error', "Product not found"); // return error
        }

        // check stock on product - if stock is 0 don't allow the user to add product to basket
        if ($product->stock == 0){
            return redirect('/')->with('error', $product->name." is out of stock");
        }

        // retreive the current basket from session
        $basket = session()->get('basket');

        // if the basket doesn't exist
        if (!$basket){
            // create new instance of the basket
            $basket = [];
            $basket['total'] = 0;
        }

        // if an instance of the product already exists within the basket
        if (isset($basket[$id])){
            // increment the quantity
            $basket[$id]['quantity']++;

            // add the price of the product
            $basket['total'] += $product->price;

            // update session
            session()->put('basket', $basket);

            // redirect back with a success message
            return redirect()->back()->with('success', 'Product added to basket successfully!');
        }

        // add new basket entry
        $basket[$id] = [
            "productId" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "cover_image" => $product->cover_image
        ];

        // add the price of the product
        $basket['total'] += $product->price;

        // update session
        session()->put('basket', $basket);

        // redirect back with a success message
        return redirect()->back()->with('success', 'Product added to basket successfully!');
    }

    public function Remove($id){
        // get the current basket
        $basket = session()->get('basket');

        // remove the item from the basket
        if (isset($basket[$id])){
            unset($basket[$id]);
        }

        // recalculate the price
        $basket['total'] = 0;

        foreach ($basket as $product){
            if ($basket['total'] == $product){
                continue;
            }
            $basket['total'] += $product['price'] * $product['quantity'];
        }

        // update the basket
        session()->put('basket', $basket);
        return redirect('/basket');
    }

    //
    // Handles update requests on the basket quantity
    //
    function Update(Request $request, $id){
        // get current basket
        $basket = session()->get('basket');

        // set the new quantity
        $basket[$id]['quantity'] = $request->quantity;

        
        // recalculate the price
        $basket['total'] = 0;

        foreach ($basket as $product){
            if ($basket['total'] == $product){
                continue;
            }
            $basket['total'] += $product['price'] * $product['quantity'];
        }

        // update the basket session
        session()->put('basket', $basket);

        // return successful json response
        return response()->json([
            'success' => true,
            'new quantity' => $basket[$id]['quantity']
        ]);  
    }
}
