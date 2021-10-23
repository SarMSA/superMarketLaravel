@foreach ($comments as $comment)
<div class="p-2" style=" margin-left:2.2rem" id="showReplay">
    <div>
        <img src="{{asset('images/avatar-512.png')}}" alt="" class="rounded-circle border" style="width: 30px" >
        <span class="">{{$comment->user->name}}</span>
    </div>
    <span class="mb-2 d-block" style="color: gray; font-size: 13px; margin-left: 2.2rem" >{{$comment->updated_at->diffForhumans()}}</span>

    <div class=" alert alert-warning border-0 mb-0">
        <i class="fas fa-location-arrow" style="position: absolute;top: -10px;transform: rotateZ(-46deg);left: -2px;color: #fff3cd;"></i>
        <p class="lead">{{$comment->content}}</p>
    </div>

    {{-- add replay............................. --}}
<form action="{{route('comments.store')}}" method="POST" id ="addReplay" style="  margin-bottom: 1rem">
    @csrf
    @method('POST')
    <div class="d-flex justify-content-between ">
        <div class="form-group mb-0 w-100">
            <textarea name="content" class="form-control" cols="30" rows="1" placeholder="Add replay"></textarea>
        </div>
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="hidden" name="parent_id" value="{{$comment->id}}">
        <button type="submit" class="btn btn-primary">Replay</button>
    </div>
</form>
@include('post.reply', ['comments'=> $comment->comment])
</div>
@endforeach   