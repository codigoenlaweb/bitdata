<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.postCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:20'],
            'image' => ['image']
        ]);

        if ($request->hasFile('image'))
        {
            Post::insert([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->file('image')->store('public/posts'),
                'likes' => 0,
                'user_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }else
        {
            Post::insert([
                'title' => $request->title,
                'content' => $request->content,
                'image' => 'public/posts/default_post.jpg',
                'likes' => 0,
                'user_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect('/dashboard')->with('message', 'Your post has been created with success!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('users.name', 'posts.*')->find($post);
        return view('posts.postShow', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        if (Auth::User()->id == $post)
        {
            $posts = Post::find($post);
            return view('posts.postEdit', compact('posts'));
        }else
        {
            return $this->redirectToRoute('dashboard')->with('message', 'Permissions denied!');
        }
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
}
