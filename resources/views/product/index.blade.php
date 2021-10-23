@extends('layouts.app')
@section('content')
    <div class="container">
        <div class=" my-5">
            <a href="{{route('products.create')}}" class="btn btn-success"> Create New Product</a>
            <a href="{{route('getTrashed')}}" class="btn btn-success"> View trashed products</a>
            {{-- @php --}}
                {{-- /*
                    auth-> the name of the class
                    user()-> the name of the model (User) model
                    product -> the name of the function of the (User model) which has the the relation between user tabel and product
                                tabel (hasMany)
                    As it has many items , it is an array of products .So we say product[0] to select only one
                    then, you can acess any column of the product table such as 'name'.
                */
                // dd(Auth::user()->product[0]->name); --}}
            {{-- // @endphp --}}
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
            @foreach ($products as $product)
                
                <tbody>
                    <tr>
                        <th scope="row">{{ ++$i}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="{{route('products.show', $product->id)}}" class="btn btn-primary"> Show </a>
                            <a href="{{route('products.edit', $product->id)}}" class="btn btn-success"> Edit </a>
                            <a href="{{route('trash', $product->id)}}" class="btn btn-warning"> Trash </a>
                            {{-- <form action="{{route('trash', $product->id)}}" class="d-inline-block" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Trash</button>
                                </div>
                            </form> --}}
                        </td>
                    </tr>
                </tbody>
            @endforeach
          </table>
    </div>
@endsection