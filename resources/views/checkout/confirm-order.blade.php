@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Order Confirmed</h4>
                </div>

                <div class="card-body">
                    <div class="alert-success p-1">
                        <p class="my-auto bold">{{$values['success']}}</p>
                    </div>
                    <br />
                    <h5>Your Order</h5>
                    
                    <table class="table">
                        <thead>
                            <tr class="row">
                                <th class="col-sm-3">Property</th>
                                <th class="col-sm-9">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="row">
                            <td class="col-sm-3">Name</td>
                            <td class="col-sm-9">{{$values['order']['name']}}</td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3">Email</td>
                            <td class="col-sm-9">{{$values['order']['email']}}</td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3">Address</td>
                            <td class="col-sm-9">{{$values['order']['address_line_1']}}</td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3"></td>
                            <td class="col-sm-9">{{$values['order']['address_line_2']}}</td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3">City</td>
                            <td class="col-sm-9">{{$values['order']['city']}}</td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3">Post Code</td>
                            <td class="col-sm-9">{{$values['order']['post_code']}}</td>
                        </tr>

                        </tbody>
                    </table>

                    <a class="btn btn-primary" href="/">Continue Shopping</a>
                    
                        
                        
                        

                        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



