<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'hola';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'coment' => ['required', 'string', 'min:5'],
        ]);

        Coments::create([
            'coment' => $request->coment,
            'posts_id' => $request->post_id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('posts/'.$request->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function show(Coments $coments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function edit(Coments $coments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coments $coments)
    {
        //
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
        return redirect('posts/'.$request->post_id);
    }
}
