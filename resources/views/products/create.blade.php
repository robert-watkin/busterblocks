@extends('layouts.app')

@section('content')
<h1 class="text-light">New Product</h1>
<div class="table bg-dark p-3">
    {!!Form::open(['action' => 'ProductsController@store', 'method' => 'post', 'files' => true, 'enctype' => 'multipart/form-data'])!!}
        <div class="form-group row">
            {!! Form::label("name", "Name", ["class" => "col-sm-2 text-light"]) !!}
            {!! Form::text("name", $product->name, ["class" => "col-sm-9"]) !!}
        </div>

        <div class="form-group row">
            {!! Form::label("description", "Description", ["class" => "col-sm-2 text-light"]) !!}
            {!! Form::textarea("description", $product->description, ["class" => "col-sm-9"]) !!}
        </div>

        <div class="form-group row">
            {!! Form::label("price", "Price", ["class" => "col-sm-2 text-light"]) !!}
            {!! Form::number("price", $product->price, ["class" => "col-sm-3", "step" => "0.01"]) !!}
        </div>
        
        <div class="form-group row">
            {!! Form::label("stock", "Stock", ["class" => "col-sm-2 text-light"]) !!}
            {!! Form::number("stock", $product->stock, ["class" => "col-sm-3", "step" => "1"]) !!}
        </div>

        <div class="form-group row">
            {!! Form::label('cover_image', 'Image', ["class" => "col-sm-2 text-light"]) !!}
            {!! Form::file('cover_image', ["class" => "bg-light p-2"]) !!}
        </div>
        
        {{Form::hidden('_method','PUT')}}
        {!! Form::submit("Save", ["class" => "btn btn-success text-light"]) !!}
    {!!Form::close()!!}

</div>
@endsection