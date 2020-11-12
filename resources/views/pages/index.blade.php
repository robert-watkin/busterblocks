@extends('layouts.app')

@section('content')
    <div class="text-light my-5 py-3 ml-5 px-2">
        <h1 class="display-3 mb-0">Busterblocks</h1>
        <h4 class="mt-0 ml-5">Evolve the way you watch...</h4>
    </div>

    <h2 class="text-light">Products</h2>
    <div class="card-deck">
    {{-- loop of products - will need to pass products through to the view--}}
    @foreach($products as $product)
    <div class="card my-3" style="min-width: 18rem">
        <img class="card-img-top" src="/storage/cover_images/{{$product->cover_image}}" />
        <div class="card-body">
            <h3 class="card-title">{{$product->name}}</h3>
            <p class="my-1"><strong>Price :</strong> £{{$product->price}}</p>
            <p class="my-1"><strong>Stock :</strong>@if($product->stock>0) {{$product->stock}} @else Out of Stock @endif</p>
        </div>
        <div class="card-footer">
            <a class="btn btn-success" href="/AddToBasket/{{$product->id}}">Add to Basket</a>
            <a class="btn btn-primary float-right" href="/products/{{$product->id}}">View</a>
        </div>
    </div>
    @endforeach
    <div>
    
@endsection('content')