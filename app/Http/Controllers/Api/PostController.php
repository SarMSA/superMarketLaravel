<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Post as PostResource;
use App\Http\Controllers\Api\baseController as BaseContoller;


class PostController extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $post = Post::where('user_id', Auth::id())->get();
        $post = Post::all();

        return $this->sendResponse(PostResource::collection($post), 'post retrieved successfully');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'content' => 'required|min:5',
            'product_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('validate Error', $validator->errors());
        }
        $request['user_id'] = Auth::id();
        $post = Post::create($request->all());
        return $this->sendResponse($post, 'post added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        if(is_null($post)) {
            return $this->sendError('error', 'not found');
        }
        return $this->sendResponse(new PostResource($post), 'post is found');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $validator = validator::make($request->all(), [
            'content' => 'required|min:5',
            'product_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('validate Error', $validator->errors());
        }
        $post->content = $request->content;
        $post->product_id = $request->product_id;
        $post->save();

        return $this->sendResponse(new PostResource($post), 'post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return $this->sendResponse(new PostResource($post), 'post deleted successfully');
    }
}
