<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::id();
        // $posts = Post::all();
        // dd($posts[0]->product->name);
        $posts = Post::with('Product','User')->where('user_id', $id)->latest()->paginate(4);
        /*
            if you use this kind of relation (with('model')), you have to write the name of the model to access it's columns.
                ex: foreach ($posts as $post)
                        $post->Product->name; -----> Product -> name of the model
                    endforeach
            But if you can just using the function you have created in your models as you cann't run the both methods without this
            function of relations...
                    ex: foreach ($posts as $post)
                        $post->product->name; -----> Product -> name of the function in Post model
                    endforeach
        */
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $id = Auth::id();
        $products = Product::where('user_id', $id)->get();
        return view('post.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'product_name' => 'required',
            'content' => 'required | min:5 | max:20000',
        ]);
        $id = Auth::id();
        // $post = Post::with('Product','User')->where('user_id', $id)->latest()->paginate(4);
        $posts = Post::create([
            'product_id' => $request->product_name,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);
        
        return redirect()->route('posts.index')->with('message', 'post created ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);        
        // $post = Post::leftJoin('comments', 'posts.id' , '=', 'comments.post_id')->where('posts.id', $id)->where('comments.parent_id', null)->get();
        // dd($post);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $this->validate($request, [
            'content' => 'required | min:5 | max:20000',
        ]);
        $id = Auth::id();
        // $post = Post::with('Product','User')->where('user_id', $id)->latest()->paginate(4);

        $post->content = $request->content;

        $post->save();

        return redirect()->route('posts.index')->with('message', 'post updated ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function softDelete($id) {
        Post::find($id)->delete();
        return redirect()->route('posts.index')->with('message', 'post deleted');
    }

    public function trashedPost(){
        $id = Auth::id();
        $posts = Post::with('Product','User')->where('user_id', $id)->onlyTrashed()->latest()->paginate(4);
        return view('post.trashed', compact('posts'));
    }
    public function restoreTrashed($id){
        Post::onlyTrashed()->where('id', $id)->first()->restore();
        return redirect()->route('posts.index')->with('message', 'post restored');
    }
    public Function deleteForEver($id){
        Post::onlyTrashed()->where('id', $id)->first()->forceDelete();
        return redirect()->route('posts.index')->with('message', 'post deleted for ever');
    }
}
