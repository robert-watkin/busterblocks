<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Returns the homepage for the application
    public function index(){
        $products = Product::get(); // get all products

        // return the home view with the products passed through
        return view('pages.index')->with('products', $products);
    }
}
