<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Evento;
use Illuminate\Support\Facades\Auth;

class EventoActividadController extends Controller
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
        $actividad = Actividad::where('id_evento',$id_evento)->get();
        $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
        return view('eventoActividad.index',['actividad' => $actividad,'id_evento' => $id_evento, 'nombre_evento' => $nombre_evento]);
      }
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
        //
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
        $actividad = Actividad::find($id)->where('id_evento',$id_evento)->get();
        return view('eventoActividad.show',['actividad' => $actividad,'id_evento'=> $id_evento]);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
