<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PanelController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($panel)
    {
        $posts = Post::where('user_id', $panel)->get();
        $coments = $coments = Post::join('coments', 'posts.id', '=', 'coments.posts_id')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('coments.id', 'coments.status', 'coments.coment', 'posts.user_id', 'users.profile', 'users.name')
        ->where('posts.user_id', $panel)
        ->where('coments.user_id', '!=', $panel)
        ->get();
        return view('panel.show_panel', compact('panel', 'posts', 'coments'));
    }


}
