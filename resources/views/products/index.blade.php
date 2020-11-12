@extends('layouts.app')

@section('content')
<h1 class="float-left text-light">Products</h1>
<a href="products/create" class="btn btn-success float-right">New Product</a>
<div class="table-responsive-xl">
<table class="table table-dark">
    <thead>
        <tr class='row bg-dark'>
            <th class='col-sm-2'>Image</th>
            <th class='col-sm-2'>Name</th>
            <th class='col-sm-4'>Description</th>
            <th class='col-sm-2'>Stock</th>
            <th class='col-sm-1'></th>
            <th class='col-sm-1'></th>
        </tr>
    <thead>
        <tbody>
        @if(count($products) > 0)
        @foreach ($products as $product)
        <tr class='row bg-dark'>
            <td class='col-sm-2'>
                <img src="storage/cover_images/{{$product->cover_image}}" class="img img-thumbnail"/>
            </td>
            <td class='col-sm-2'><a href="/products/{{$product->id}}" class="text-light">{{$product->name}}</td>
            <td class='col-sm-4'>{{$product->description}}</td>
            <td class='col-sm-2'>{{$product->stock}}</td>
            <td class='col-sm-1'>
                <a href="products/{{$product->id}}/edit" class="btn btn-secondary">Edit</a>
            </td>
            <td class='col-sm-1'>
                {!! Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
    @else
    <tr class="row">
        <td class="col-sm-12 text-center">
            <h2>There are no products!</h2>
        </td>
    </tr>
    @endif
</table>
</div>
</div>
@endsection('content')