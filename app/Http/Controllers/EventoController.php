<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Area;
use App\AreaEvento; 
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    protected $redirectTo = '/home';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        $evento = Evento::all();
        return view('evento.index',['evento' => $evento]);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evento.create');
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
        'nombre' =>  'required',
        'fecha_inicio' =>  'required',
        'fecha_fin' =>  'required',
        'certificado_por_actividad' => 'required'
      ]);


      $request->merge(['creador' => Auth::id()]);
      $request->merge(['estado' => 'inscripciones']);


      $nuevoEvento = Evento::create($request->all());

      $areas = $request->input('area');
      for($i=0; $i<count($areas); $i++)
      {
        $area = new Area(['nombre' => $areas[$i]]);
        $area->save();
        $area_evento = new AreaEvento(['id_area' => $area->id,
                                       'id_evento' => $nuevoEvento->id]);
        $area_evento->save();
      }


      return redirect('/home')
              ->with('success','evento creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $evento = Evento::find($id);
      return view('evento.show',['evento' => $evento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $evento = Evento::find($id);
      return view('evento.edit',['evento' => $evento]);
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
        'nombre' =>  'required',
        'fecha_inicio' =>  'required',
        'fecha_fin' =>  'required',
        'cant_max_actividades' =>  'required|numeric',
        'punt_min_aprobatorio' =>  'required|numeric', //50%
      ]);

      Evento::find($id)->update($request->all());

      return redirect()->route('evento.index')
              ->with('message','evento editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Evento::find($id)->delete();

      return redirect()->route('evento.index')
              ->with('message','evento eliminado');
    }

    public function mis_eventos()
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        $evento = Evento::where('creador',Auth::id())->get();
        return view('evento.index',['evento' => $evento]);
      }

    }
}
