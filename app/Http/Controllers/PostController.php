<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->file('image')->store('public/posts'),
                'user_id' => Auth::user()->id,
            ]);

        }else
        {
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => 'public/posts/default_post.jpg',
                'user_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('dashboard')->with('message', 'Your post has been created with success!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('users.name', 'users.user', 'posts.*')->find($post);
        $coments = Coments::join('users', 'users.id', '=', 'coments.user_id')->select('users.name', 'users.profile',  'coments.*')->where('posts_id', $post)->get();
        $countcoments = Coments::where('posts_id', $post)->where('status', 0)->get()->count();
        $post_like = Like::where('posts_id', $post)->where('user_id', Auth::user()->id)->get();
        $post_like_count = Like::where('posts_id', $post)->where('user_id', Auth::user()->id)->get()->count();
        $countlikes = Like::where('posts_id', $post)->get()->count();
        return view('posts.postShow', compact('posts', 'coments', 'countcoments', 'countlikes', 'post_like', 'post_like_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $posts = Post::find($post);
        return view('posts.postEdit', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:20'],
            'image' => ['image']
        ]);

        $posts = Post::find($post);

        if ($request->hasFile('image'))
        {
            if ($posts->image != 'public/posts/default_post.jpg') {
                $url = str_replace('storage', 'public', $posts->image);

                Storage::delete($url);
            }
            $posts->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->file('image')->store('public/posts'),
                'likes' => 0,
                'user_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }else
        {
            $posts->update([
                'title' => $request->title,
                'content' => $request->content,
                'likes' => 0,
                'user_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('posts.show', ['post' => $request->post_id])->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $posts = Post::find($post);

        if ($posts->image != 'public/posts/default_post.jpg') {
            $url = str_replace('storage', 'public', $posts->image);

            Storage::delete($url);
        }
        Post::destroy($post);
        return redirect()->route('dashboard')->with('message', 'Your post has been deleted!');
    }
}
