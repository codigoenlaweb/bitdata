<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
        ->select('users.name', 'users.github', 'users.facebook', 'users.instagram', 'users.twiter', 'posts.*')
        ->cursorPaginate(8);
        return view('dashboard', compact('posts'));
    }
}
