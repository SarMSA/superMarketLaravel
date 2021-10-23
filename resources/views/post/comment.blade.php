{{-- @if (!empty($comments)) --}}
{{-- {{dd($comments[1]->comment)}} --}}
            @foreach ($comments as $comment)
            <div class="p-2">
                <div>
                    <img src="{{asset('images/avatar-512.png')}}" alt="" class="rounded-circle border" style="width: 30px" >
                    <span class="">{{$comment->user->name}}</span>
                </div>
                <span class="mb-2 d-block" style="color: gray; font-size: 13px; margin-left: 2.2rem" >{{$comment->updated_at->diffForhumans()}}</span>

                <div class=" alert alert-success border-0 mb-0">
                    <i class="fas fa-location-arrow" style="position: absolute;top: -10px;transform: rotateZ(-46deg);left: -2px;color: #d4edda;"></i>
                    <p class="lead">{{$comment->content}}</p>
                </div>
                @include('post.reply', ['comments'=> $comment->comment])

                {{-- add replay............................. --}}
            <form action="{{route('comments.store')}}" method="POST" >
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
        </div>
            @endforeach   
            {{-- <script>
                function replay{{$comment->id}}(){
                    $("#addReplay").toggle(function(){
                        $(this).css('diplay', 'block')
                    })
                }
                function showReplay(){
                    $("#showReplay").toggle(function(){
                        $(this).css('diplay', 'block')
                    })
                }
            </script>        --}}
        {{-- @endif --}}