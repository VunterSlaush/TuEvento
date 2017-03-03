<?php

namespace App\Http\Controllers;

use App\User;
use App\Evento;
use App\Encuesta;
use App\Pregunta;
use App\Actividad;
use App\Opcion;
use App\EncuestaPregunta;
use Illuminate\Http\Request;

class EventoEncuestaController extends Controller
{
  public function createEncuesta($id_evento)
  {
    $evento = Evento::where('id',$id_evento)->first();
    return view('Encuesta.createEncuesta',['evento' => $evento]);
  }

  public function createPregunta($id_evento)
  {
    $evento = Evento::where('id',$id_evento)->first();
    return view('Encuesta.createPregunta',['evento' => $evento]);
  }

  public function storeEncuesta(Request $request,$id_evento)
  {
    $tipo = $request->input('tipo');
    $encuesta = Encuesta::create(['nombre'=> $request->input('nombre'), 'id_evento' => $id_evento, 'tipo' => $tipo ]);
    $preguntas = $request->input('preguntas');
    foreach ($preguntas as $key => $value) {
      EncuestaPregunta::create(['id_pregunta' => $value, 'id_encuesta'=> $encuesta->id]);
    }
    return json_encode(['success' => true]);
  }

  public function storePregunta(Request $request)
  {
    $id_evento = $request->input('id_evento');
    $evento = Evento::where('id',$id_evento);

    $pregunta = Pregunta::create(['id_evento' => $id_evento, 'pregunta' =>$request->input('pregunta')]);
    $opciones = $request->input('opciones');

    foreach ($opciones as $key => $value)
    {
        //dd($value);
        Opcion::create(['opcion'=>$value['opcion'], 'valor'=> $value['valor'], 'id_pregunta'=>$pregunta->id]);
    }
    return json_encode(['success'=>true]);
  }

  public function responderEncuestaActividad($id_actividad)
  {
    $actividad = Actividad::find($id_actividad);
    $encuesta = Encuesta::where('id_evento',$actividad->id_evento)->where('tipo','satisfaccion')->first();
    if($encuesta != null)
    {
      return view('Encuesta.responder',['encuesta' => $encuesta, 'id_actividad'=> $id_actividad]);
    }
    else
    {
      return redirect('/home');//TODO redireccionar bien ..?
    }

  }
}