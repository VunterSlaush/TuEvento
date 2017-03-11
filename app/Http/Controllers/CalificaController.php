<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Califica;
use App\Propuesta;
use App\Comite;
use App\Evalua;
use App\TipoActividadEvento;
use App\Jurado;


class CalificaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('califica.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calificada()
    {
      $evaluados = Auth::user()->evaluaciones;
      $calificadas = collect();
      foreach ($evaluados as $key => $value) {
        $calificadas->push($value->propuesta);
      }
      return view('califica.calificada',['propuestas' => $calificadas]);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function porcalificar()
    {
      $juradoEn = Jurado::where('id_user',Auth::id())->get();
      $evaluados = Auth::user()->evaluaciones;
      $evaluados = $evaluados->pluck('id_propuesta');
      $propuestasPorCalificar = collect();
      foreach ($juradoEn as $key => $jurado)
      {
        $propuestasPorCalificar = $propuestasPorCalificar->merge($this->conseguirPropuestasEvento($jurado));
      }

      $propuestasPorCalificar = $propuestasPorCalificar->filter(function($value, $key) use(&$evaluados)
      {
        return !$evaluados->contains($value->id);
      });

      return view('califica.pendiente',['propuestas' => $propuestasPorCalificar]);
    }

    private function conseguirPropuestasEvento($jurado)
    {
      $areas = $jurado->areas;
      $propuestas = collect();

      foreach ($areas as $key => $value)
      {
        $propuestas = $propuestas->merge($this->propuestasEvaluablesSegunArea($jurado,$value));
      }
      //dd($propuestas);
      return $propuestas;
    }

    private function propuestasEvaluablesSegunArea($jurado, $area)
    {
      $propuestas = Propuesta::where('id_area',$area->id_area)->
                               where('id_evento',$jurado->id_evento)->
                               get();

      return $propuestas->filter(function ($value, $key) use(&$jurado)
      {
        return $this->esEvaluable($value->tipo, $jurado->evento);
      });
    }

    private function esEvaluable($tipo, $evento)
    {
      return null != TipoActividadEvento::where('id_tipo',$tipo->id)->where('id_evento',$evento->id)
              ->where('evaluable',true)->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }


}
