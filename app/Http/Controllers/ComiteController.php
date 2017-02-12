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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comite.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'id_evento' =>  'required',
        'cedula' =>  'required',
      ]);

      // if ($this->comiteExists($request->id_evento,$request->cedula) == 0){
        Comite::create($request->all());

        return redirect()->route('comite.index')
                ->with('success','comite creado');
      // }

      // return redirect()->route('comite.index')
      //         ->withErrors(['failed','Error usuario ya en comite de evento']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $comite = Comite::find($id);
      return view('comite.show',['comite' => $comite]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $comite = Comite::find($id);
      return view('comite.edit',['comite' => $comite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'cedula' =>  'required',
        'id_evento' =>  'required',
      ]);

      Comite::find($id)->update($request->all());

      return redirect()->route('comite.index')
              ->with('success','comite editado');
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
