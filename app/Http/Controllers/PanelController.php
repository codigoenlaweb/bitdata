<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($panel == Auth::user()->id) {

            $posts = Post::where('user_id', $panel)->orderBy('id', 'DESC')->get();

            $coments = Coments::join('users', 'coments.user_id', '=', 'users.id')
            ->join('posts', 'coments.posts_id', '=', 'posts.id')
            ->select('coments.id', 'coments.coment', 'users.name', 'coments.user_id', 'users.profile', 'coments.status')
            ->where('coments.user_id', '!=', $panel)
            ->where('posts.user_id', '=', $panel)
            ->orderBy('id', 'DESC')->Paginate(12);

            $adminposts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.banned', 'users.user')
            ->orderBy('id', 'DESC')
            ->get();

            $admincoments = Coments::join('users', 'coments.user_id', '=', 'users.id')
            ->join('posts', 'coments.posts_id', '=', 'posts.id')
            ->select('coments.id', 'coments.coment', 'users.name', 'coments.user_id', 'users.profile', 'users.banned', 'coments.status')
            ->where('coments.user_id', '!=', $panel)
            ->orderBy('id', 'DESC')->Paginate(12);

            return view('panel.show_panel', compact('panel', 'posts', 'coments', 'adminposts', 'admincoments'));
        }else{
            return redirect()->route('panel.show', ['panel' => Auth::user()->id]);
        }

    }


}
