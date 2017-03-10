<?php

namespace App\Http\Controllers;

use App\User;
use App\Evento;
use App\Encuesta;
use App\Pregunta;
use App\Actividad;
use App\Opcion;
use App\Califica;
use App\EncuestaPregunta;
use App\Respuesta;
use App\Propuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      return view('Encuesta.responder',['encuesta' => $encuesta, 'id'=> $id_actividad, 'tipo' => 'satisfaccion']);
    }
    else
    {
      return redirect('/home');//TODO redireccionar bien ..?
    }
  }


  public function responderEncuestaPropuesta($id_propuesta, $id_encuesta)
  {
    $propuesta = Propuesta::find($id_propuesta);
    $encuesta = Encuesta::find($id_encuesta);
    if($encuesta != null)
    {
      return view('Encuesta.responder',['encuesta' => $encuesta, 'id'=> $id_propuesta, 'tipo' => 'evaluacion']);
    }
    else
    {
      return redirect('/home');//TODO redireccionar bien ..?
    }
  }


  //TODO hacer el Transaction aqui!, si da error retornar el json con msg !
  public function guardarRespuestaSatisfaccion(Request $request)
  {
    $id_actividad = $request->input('id_actividad');
    $id_encuesta = $request->input('id_encuesta');
    $respuestas = $request->input('respuestas');
    $id_user = Auth::id();
    $califica = Califica::create([
    					'id_actividad'=> $id_actividad,
              'id_encuesta'=>$id_encuesta,
    					'id_user'=>$id_user
    					 ]);
    foreach ($respuestas as $key => $value)
    {
      Respuesta::create(['id_opcion'=>$value['id_opcion'], 'id_califica' => $califica->id, 'tipo' =>'satisfaccion']);
    }
    return json_encode(['success' => true]);
  }

  public function seleccionarEncuestaEvaluacion($id_propuesta)
  {
    $propuesta = Propuesta::find($id_propuesta);
    $encuestas =  Encuesta::where('id_evento',$propuesta->id_evento)
                         ->where('tipo','evaluacion')
                         ->get();
    if($propuesta != null)
    {
      return view('Encuesta.seleccionar',['propuesta' => $propuesta, 'encuestas' => $encuestas]);
    }
    return redirect('/home');
  }
}
