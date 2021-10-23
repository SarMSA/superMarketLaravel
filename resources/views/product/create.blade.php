@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('products.index')}}" class="btn btn-info">Back to home page</a>

        <form action="{{route('products.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="exampleInputname">Name</label>
                <input type="text" class="form-control" id="exampleInputname" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputprice">Price</label>
                <input type="text" class="form-control" id="exampleInputprice" placeholder="Enter price" name="price">
            </div>
            <div class="form-group">
                <label for="exampleInputdetail">Details</label>
                <textarea name="detail" class="form-control" id="exampleInputdetail" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
    </div>
@endsection