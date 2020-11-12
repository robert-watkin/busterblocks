@extends('layouts.app')

@section('content')
    <h1 class="text-light">{{$product->name}}</h1>
    <div class="row" class="text-light">
        <div class="col-sm-5">
            <img class="img-thumbnail" src="/storage/cover_images/{{$product->cover_image}}">
        </div>
        <div class="col-sm-7 card p-3">
            <h5><strong>Description</strong></h5>
            <p>{{$product->description}}</p>

            <div>
            <p class="my-0"><strong>Price :</strong>£{{$product->price}}</p>
            @if ($product->stock > 0)
                <p><strong>Stock :</strong>{{$product->stock}}</p>
            @else
                <p><strong>Stock : <em>Out of Stock</em></strong></p>
            @endif
            <a href="/AddToBasket/{{$product->id}}" class="btn btn-success ">Add to Basket</a>

            </div>
        </div>
    </div>

@endsection('content')