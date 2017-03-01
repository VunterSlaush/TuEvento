<?php

namespace App\Http\Controllers;
use App\User;
use App\Evento;
use App\Encuesta;
use App\Pregunta;
use App\Opcion;
use App\EncuestaPregunta;


use Illuminate\Http\Request;

class EventoEncuestaController extends Controller
{
  public function createEncuesta($id_evento)
  {
    $evento = Evento::where('id',$id_evento);
    return view('Encuesta.createEncuesta',['evento' => $evento]);
  }

  public function createPregunta($id_evento)
  {
    $evento = Evento::where('id',$id_evento);
    return view('Encuesta.createPregunta',['evento' => $evento]);
  }

  public function storeEncuesta(Request $request)
  {

  }

  public function storePregunta(Request $request)
  {

  }
}
