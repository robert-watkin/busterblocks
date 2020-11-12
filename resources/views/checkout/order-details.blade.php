@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Order Details</h4>
                    <p class="p-0 m-0 float-right">* Indicates Required Field</p>
                </div>

                <div class="card-body">
                    {!!Form::open(['action' => 'CheckoutController@SubmitCheckout', 'method' => 'post'])!!}
                        @csrf

                        <h5>Your Details</h5>

                        <div class="form-group row">
                            
                            {!! Form::label("name", "Name*", ["class" => "col-md-4 col-form-label text-md-right"]) !!}

                            <div class="col-md-6">

                                {!! Form::text("name", Auth::user()->name, ["class" => "form-control"]) !!}
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label("email", "Email*", ["class" => "col-md-4 col-form-label text-md-right"]) !!}

                            <div class="col-md-6">
                                {!! Form::text("email", Auth::user()->email, ["class" => "form-control"]) !!}
                            </div>
                        </div>
                        
                        <h5>Delivery Address</h5>

                        <div class="form-group row">
                            {!! Form::label("addressLine1", "Address Line 1*", ["class" => "col-md-4 col-form-label text-md-right"]) !!}

                            <div class="col-md-6">
                                {!! Form::text("addressLine1", "", ["class" => "form-control"]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label("addressLine2", "Address Line 2", ["class" => "col-md-4 col-form-label text-md-right"]) !!}

                            <div class="col-md-6">
                                {!! Form::text("addressLine2", "", ["class" => "form-control"]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label("city", "City*", ["class" => "col-md-4 col-form-label text-md-right"]) !!}

                            <div class="col-md-6">
                                {!! Form::text("city", "", ["class" => "form-control"]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label("postCode", "Post Code*", ["class" => "col-md-4 col-form-label text-md-right"]) !!}

                            <div class="col-md-6">
                                {!! Form::text("postCode", "", ["class" => "form-control"]) !!}
                            </div>
                        </div>

                        <hr />

                        <div class="form-group row">
                            <p class="col-md-4 col-form-label text-md-right">Total</p>

                            <div class="col-md-6">
                                <p class="m-2">£{{ session()->get('basket')['total']}}</p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit("Purchase", ["class" => "btn btn-success"]) !!}
                            </div>
                        </div>

                        
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



