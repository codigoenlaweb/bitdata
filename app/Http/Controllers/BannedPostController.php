<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BannedPostController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $banned_post)
    {
        $user_banned = User::find($banned_post);
        $user_banned->update([
            'banned' => '1'
        ]);

        return redirect()->route('posts.show', ['post' => $request->post_id])->with('message', 'the user has been banned!');
    }

}
