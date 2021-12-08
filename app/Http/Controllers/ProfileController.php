<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($profile)
    {
        if ($profile == Auth::user()->id) {
            return view('profile.show', compact('profile'));
        }else{
            return redirect()->route('profile.show', ['profile' => Auth::user()->id]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profile)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:60'],
            'profile' => ['image']
        ]);

        if (Auth::user()->email != $request->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        if (Auth::user()->user != $request->user) {
            $request->validate([
                'user' => ['required', 'string', 'unique:users', 'max:60'],
            ]);
        }


        $user_profile = User::find($profile);
        if ($request->hasFile('profile'))
        {
            if (Auth::user()->profile != 'public/users/default_user.jpg') {
                $url = str_replace('storage', 'public', Auth::user()->profile);
                Storage::delete($url);
            }
            $user_profile->update([
                'name' => $request->name,
                'user' => $request->user,
                'email' => $request->email,
                'profile' => $request->file('profile')->store('public/users'),
                'instagram' => $request->instagram,
                'twiter' => $request->twiter,
                'facebook' => $request->facebook,
                'github' => $request->github,
            ]);

        }else
        {
            $user_profile->update([
                'name' => $request->name,
                'user' => $request->user,
                'email' => $request->email,
                'instagram' => $request->instagram,
                'twiter' => $request->twiter,
                'facebook' => $request->facebook,
                'github' => $request->github,
            ]);
        }

        return redirect()->route('profile.show', ['profile' => Auth::user()->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
