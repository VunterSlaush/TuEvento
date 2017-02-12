<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propuesta;
use App\Evento;
use App\TipoActividad;
use App\Area;
use Illuminate\Support\Facades\Auth;

class EventoPropuestaController extends Controller
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
        $propuesta = Propuesta::where('id_evento',$id_evento)->get();
        return view('eventoPropuesta.index',['propuesta' => $propuesta,'id_evento' => $id_evento]);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_evento)
    {
      $evento = Evento::where('id','=',$id_evento)->first();
      return view('eventoPropuesta.create',['evento' => $evento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_evento)
    {

      $request->merge(['autor' => Auth::id()]);
      $request->merge(['id_evento' => $id_evento]);
      $area_value = $request->input('area');
      $tipo_value = $request->input('tipo');
      $area = Area::where('nombre','=',$area_value)->first();
      $tipo = TipoActividad::where('nombre','=',$tipo_value)->first();
      $request->merge(['id_area' => $area->id]);
      $request->merge(['id_tipo' => $tipo->id]);
      Propuesta::create($request->all());

      return redirect()->route('evento.propuesta.index',['id_evento' => $id_evento])
              ->with('success','propuesta creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_evento,$id_propuesta)
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        $propuesta = Propuesta::find($id_propuesta);
        return view('eventoPropuesta.show',['propuesta' => $propuesta,'id_evento'=> $id_evento]);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_evento,$id_propuesta)
    {
      $propuesta = Propuesta::find($id_propuesta);
      return view('eventoPropuesta.edit',['propuesta' => $propuesta,'id_evento'=> $id_evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_evento,$id_propuesta)
    {
      Propuesta::find($id_propuesta)->update($request->all());

      return redirect()->route('evento.propuesta.index',['id_evento' => $id_evento])
              ->with('success','propuesta editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_evento,$id_propuesta)
    {
      Propuesta::find($id_propuesta)->delete();

      return redirect()->route('evento.propuesta.index',['id_evento' => $id_evento])
              ->with('success','propuesta eliminada');
    }
}
