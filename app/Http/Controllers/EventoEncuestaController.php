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
use App\Evalua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


  public function guardarRespuesta(Request $request)
  {
    if($request->input('tipo') == 'satisfaccion')
      return $this->guardarRespuestaSatisfaccion($request);
    else
      return $this->guardarRespuestaEvaluacion($request);
  }

  public function guardarRespuestaSatisfaccion(Request $request)
  {

    try {
      DB::beginTransaction();

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

      DB::commit();

    } catch (QueryException $e) {
      DB::rollBack();
      return json_encode(['success' => false,'msg' => $e]);
    }

    return json_encode(['success' => true]);
  }

  public function guardarRespuestaEvaluacion(Request $request)
  {
    $id_propuesta = $request->input('id');
    $id_encuesta = $request->input('id_encuesta');
    $respuestas = $request->input('respuestas');
    $id_user = Auth::id();
    $evalua = Evalua::create([
              'id_propuesta'=> $id_propuesta,
              'id_encuesta'=>$id_encuesta,
              'cedula'=>$id_user
               ]);
    foreach ($respuestas as $key => $value)
    {
      Respuesta::create(['id_opcion'=>$value['id_opcion'], 'id_evalua' => $evalua->id, 'tipo' =>'evaluacion']);
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

  public function verPreguntas($id_evento)
  {
    $preguntas = Pregunta::where('id_evento',$id_evento)->get();
      return view('Encuesta.preguntas',['preguntas' => $preguntas]);
  }

  public function verEncuestas($id_evento)
  {
    $encuestas = Encuesta::where('id_evento',$id_evento)->get();
    $preguntas = collect();
    foreach ($encuestas as $key => $value) {
      foreach ($value->preguntas as $key => $p)
      {
        $preguntas->push(['pregunta' => $p->pregunta->pregunta, 'id_pregunta' => $p->id_pregunta, 'id_encuesta' => $p->id_encuesta, 'id' =>$p->id]);
      }
    }
    return view('Encuesta.encuestas',['encuestas' => $encuestas, 'preguntas' => $preguntas]);
  }

  //TODO permisos para borrar este beta?
  public function borrarOpcion(Request $request)
  {
    $id = $request->input('id_opcion');
    $opcion = Opcion::find($id);
    $opcion->delete();
    return json_encode(['success'=>true]);
  }

  public function borrarPregunta(Request $request)
  {
    $id = $request->input('id_pregunta');
    $Pregunta = Pregunta::find($id);
    $Pregunta->delete();
    return json_encode(['success'=>true]);
  }

  public function borrarEncuesta(Request $request)
  {
    $id = $request->input('id_encuesta');
    $Pregunta = Encuesta::find($id);
    $Pregunta->delete();
    return json_encode(['success'=>true]);
  }

  public function borrarEncuestaPregunta(Request $request)
  {
    $id = $request->input('id_pregunta');
    $pregunta = EncuestaPregunta::find($id);
    $pregunta->delete();
    return json_encode(['success'=>true]);
  }
}
