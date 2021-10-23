@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('posts.index')}}" class="btn btn-info">Back to home page</a>
        <h3>Product Name: {{$post->product->name}}</h3>
        <form action="{{route('posts.update', $post->id)}}" method="POST">
            @csrf
            @method('Put')
            <div class="form-group">
                <label for="exampleInputprice">Content</label>
                <textarea name="content" class="form-control" cols="30" rows="5" placeholder="Enter content">{{$post->content}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>

    </div>
@endsection