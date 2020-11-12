<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    // constructor to handle permissions
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['AddToBasket', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all products from the database
        $products = Product::get();
        // return the index view and pass along the full list of products
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // returns the view to create a new product
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validation
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'cover_image' => 'image|nullable|max:1999' // max image size 1.999mb - Apache usually limits to 2mb
        ]);
            
        // handle file upload
        if($request->hasFile('cover_image')){
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images/', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        

        // try catch block to handle possible exceptions
        try {
            // create new product and set values based on request input
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->cover_image = $fileNameToStore;
            $product->save();   // save the new product to the DB
        } catch(Exception $e){
            // if an exception has been caught - return to the products page with an error message
            return redirect('/products')->with('error', 'There has been a problem creating the product');
        }

        // Upon successfully creating the product - return to the products page with a success message
        return redirect('/products')->with('success', 'The product has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // Returns the view and passes through the product
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // return the edit view and pass through the product being editted
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // handle file upload
        if($request->hasFile('cover_image')){
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } 

        // try catch block to handle possible exceptions
        try {
            // where product is the item being updated and request has the new information
            // set the properties of the product to all that is within the request
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            if($request->hasFile('cover_image')){
                $product->cover_image = $fileNameToStore;
            }

            $product->update(); // update the product on the DB
        } catch (Exception $e){
            // if an exception has been caught - return to the products page with an error message
            redirect('/products')-with('error', 'There has been a problem updating the product');
        }

        // Upon successfully updating the product - return to the products page with a success message
        return redirect('/products')->with('success', 'The product has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // try catch block to handle possible exceptions
        try {

            if ($product->cover_image != "noimage.jpg"){
                Storage::delete('public/cover_images/'.$product->cover_image);
            }

            $product->delete(); // attempt to remove the product from the DB
        } catch(Exception $e){
            // if an exception has been caught - return to the products page with an error message
            redirect('/products')-with('error', 'There has been a problem deleting the product');
        }

        // Upon successfully deleting the product - return to the products page with a success message
        return redirect('/products')->with('success', 'The product has been removed successfully');
    }

}
