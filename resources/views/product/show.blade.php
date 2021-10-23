@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('products.index')}}" class="btn btn-info">Back to home page</a>
        <div class="form-group">
            <h6>product name : {{$product->name}}</h6>
        </div>
        <div class="form-group">
            <h6>product price : {{$product->price}}</h6>
        </div>
        <div class="form-group">
            <p>product details : 
            @if ($product->detail)
                {{$product->detail}}
            @else 
                no details for this product
            @endif
            </p>
        </div>
    </div>
@endsection