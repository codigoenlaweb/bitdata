<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use Illuminate\Http\Request;

class ComentDropPanelController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $coment_drop_panel)
    {
        Coments::destroy($coment_drop_panel);

        return redirect()->route('panel.show', ['panel' => $request->panel_id]);
    }
}
