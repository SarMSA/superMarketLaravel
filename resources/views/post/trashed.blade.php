@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('posts.index')}}" class="btn btn-info">Back to home page</a>
        <div class=" my-5">
            <a href="{{route('posts.create')}}" class="btn btn-success"> Create New Product</a>
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
                  <th scope="col">Product</th>
                  <th scope="col">Content</th>
                  <th scope="col">Added by</th>
                  <th scope="col">Added at</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
            @php
                $i= 0  
            @endphp
   
            
            @foreach ($posts as $post)
                <tbody>
                    <tr>
                        <th scope="row">{{ ++$i}}</th>
                        <td>{{$post->Product->name}}</td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->User->name}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                            <a href="{{route('post.deleteForEver', $post->id)}}" class="btn btn-danger" method="POST">Delete</a>
                            <a href="{{route('post.restoreTrashed', $post->id)}}" class="btn btn-success" method="POST">restore</a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
          </table>
          @empty($posts->items())
                <div class="alert alert-info text-center">no trashed products </div>
            @endempty
    </div>
@endsection