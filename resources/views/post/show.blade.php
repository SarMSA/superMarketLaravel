@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="jumbotron p-2 ">
            <div class="ml-auto">
                <img src="{{asset('images/avatar-512.png')}}" alt="" class="rounded-circle border" style="width: 50px" >
                <span class="">{{$post->user->name}}</span>
            </div> 
            <hr>
            <div class="pl-5">
                <h4 class="display-4">{{$post->product->name}}</h4>
                 <p class="lead">{{$post->content}}</p>
            </div>
        </div>
        {{-- comments ......................................... --}}
            <div>
                <h5>Comments:</h5>
                <hr style="width: 10%; color: black; height: 5px; margin-left:0">
                
                @include('post.comment', ['comments' => $post->comment, 'post_id'=> $post->id])
                
                <form action="{{route('comments.store')}}" method="POST" class="mt-5">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <textarea name="content" class="form-control" cols="30" rows="1" placeholder="Add comment"></textarea>
                    </div>
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    {{-- <input type="hidden" name="parent_id" value="{{$post->id}}"> --}}
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
    </div>
    
@endsection