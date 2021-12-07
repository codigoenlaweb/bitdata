<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Like::create([
            'like' => 1,
            'user_id' => Auth::user()->id,
            'posts_id' => $request->post_id,
        ]);

        return redirect()->route('posts.show', ['post' => $request->post_id]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Like $like)
    {
        Like::destroy($like->id);
        return redirect()->route('posts.show', ['post' => $request->post_id]);
    }
}
