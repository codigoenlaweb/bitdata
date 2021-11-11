<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('users.name', 'posts.*')->cursorPaginate(4);
        return view('dashboard', compact('posts'));
    }
}
