@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('products.index')}}" class="btn btn-info">Back to home page</a>
        <div class=" my-5">
            <a href="{{route('products.create')}}" class="btn btn-success"> Create New Product</a>
        </div>
        @if (session('message'))
        <div class="alert alert-primary">
                {{session('message')}}
            </div>
        @endif
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            @php
                $i= 0  
            @endphp
   
            @empty($products->items())
                <div class="alert alert-info">no trashed products </div>
            @endempty
            @foreach ($products as $product)
                <tbody>
                    <tr>
                        <th scope="row">{{ ++$i}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="{{route('deleteForEver', $product->id)}}" class="btn btn-danger" method="POST">Delete</a>
                            <a href="{{route('restoreTrashed', $product->id)}}" class="btn btn-success" method="POST">restore</a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
          </table>
    </div>
@endsection