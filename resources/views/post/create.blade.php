@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('posts.index')}}" class="btn btn-info">Back to home page</a>

        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="exampleInputname">Name</label>
                <select class="custom-select" name="product_name">
                    <option selected disabled value="">Choose...</option>
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputprice">Content</label>
                <textarea name="content" class="form-control" cols="30" rows="5" placeholder="Enter content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>

    </div>
@endsection