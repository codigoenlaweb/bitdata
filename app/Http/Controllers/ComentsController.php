<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coment' => ['required', 'string', 'min:5'],
        ]);

        Coments::create([
            'coment' => $request->coment,
            'posts_id' => $request->post_id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('posts.show', ['post' => $request->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Coments $coment)
    {
        $coment_delete = Coments::find($coment);
        Coments::destroy($coment_delete);

        return redirect()->route('posts.show', ['post' => $request->post_id]);
    }
}
