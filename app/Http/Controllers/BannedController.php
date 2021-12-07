<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BannedController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $banned)
    {
        $user_banned = User::find($banned);
        $user_banned->update([
            'banned' => '1'
        ]);

        return redirect()->route('panel.show', ['panel' => $request->panel_id]);
    }

}
