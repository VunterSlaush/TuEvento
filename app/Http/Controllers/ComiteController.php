<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Evento;
use App\Comite;

class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comite = Comite::where('id_user','=',Auth::id())->get();
        return view('comite.index',['comite' => $comite]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Comite::find($id)->delete();

      return redirect()->route('comite.index')
              ->with('success','comite eliminado');
    }

    private function comiteExists($id_evento,$cedula){
      return count(Comite::where('id_evento',$id_evento)
             ->where('cedula',$cedula));
    }
}
