@extends('layouts.app')
@section('content')
    <div class="container">
        <div class=" my-5">
            <a href="{{route('posts.create')}}" class="btn btn-success"> Create New Post</a>
            <a href="{{route('post.getTrashed')}}" class="btn btn-success"> View trashed posts</a>
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
        <table class="table text-center">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Content</th>
                <th scope="col">Added by</th>
                <th scope="col">Added at</th>
                @php
                    $update = 0;
                    foreach ($posts as $post) {
                        if ($post->created_at != $post->updated_at) {
                            $update += 1;
                        }
                    }
                @endphp
                @if ($update > 0)
                <th scope="col">Updated at</th>     
                @endif
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
                        <td>{{$post->Product->name}}</td>  {{-- Product -> name of the model --}}
                        <td>{{$post->content}}</td>
                        <td>{{$post->user->name}}</td>  {{-- user -> name of the function --}}
                        <td>{{$post->created_at->diffForhumans()}}</td>
                        @if ($update > 0)
                            <td>@if ($post->updated_at != $post->created_at)
                                    {{$post->updated_at->diffForhumans()}}
                                @else
                                    __
                                @endif
                            </td>
                        @endif
                        <td>
                            <a href="{{route('posts.show', $post->id)}}" class="btn btn-info"> Show </a>
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-success"> Edit </a>
                            <a href="{{route('post.trash', $post->id)}}" class="btn btn-warning"> Trash </a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
          </table>
    </div>
@endsection