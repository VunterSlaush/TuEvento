<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comite;
use App\Evento;

class EventoComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_evento)
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        $comite = Comite::where('id_evento',$id_evento)->get();
        return view('eventoComite.index',['comite' => $comite,'id_evento' => $id_evento]);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_evento)
    {
        return view('eventoComite.create',['id_evento' => $id_evento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id_evento)
    {
      $request->merge(['cedula' => Auth::id()]);
      $request->merge(['id_evento' => $id_evento]);

        Comite::create($request->all());

        return redirect()->route('evento.comite.index',['id_evento' => $id_evento])
                ->with('success','comite creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_evento,$id)
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        $comite = Comite::find($id)->where('id_evento',$id_evento)->get();
        return view('eventoComite.show',['comite' => $comite,'id_evento'=> $id_evento]);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_evento,$id)
    {
      $comite = Comite::find($id);
      return view('eventoComite.edit',['comite' => $comite,'id_evento'=> $id_evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_evento,$id)
    {
      Comite::find($id)->update($request->all());

      return redirect()->route('evento.comite.index',['id_evento' => $id_evento])
              ->with('success','comite editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_evento,$id)
    {
      Comite::find($id)->delete();

      return redirect()->route('evento.comite.index',['id_evento' => $id_evento])
              ->with('success','comite eliminada');
    }
}
