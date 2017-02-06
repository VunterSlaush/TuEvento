<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use View;


class SearcherController extends Controller
{

    public function searchActivities(Request $request){
      	
      $busqueda = \Request::get('titulo');
 
      $actividades = DB::table('actividad')
      ->select('users.nombre AS nombre_ponente','users.cedula','evento.nombre AS nombre_evento','fecha','titulo','hora_inicio')
      ->join('users', 'actividad.ponente', '=', 'users.cedula')
      ->join('evento','actividad.evento', '=', 'evento.id')
      ->where('actividad.titulo','=',$busqueda)
      ->get();

      return view('search-activities',['actividades' => $actividades]);

    }

}
