<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use View;
use App\Actividad;
use App\Evento;
use App\TipoActividad;
use App\Area;


class SearcherController extends Controller
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

    public function searchActividad($search){

      $actividades = Actividad::where('titulo', 'LIKE', '%'.$search.'%')->get();
      return json_encode($actividades);

    }
    //TODO Realizar mejor la Consulta! Buscar Las actividades de un eventos
    // Las Actividades de un Area, Las Actividades de un tipo
    public function searchEvento($search)
    {
      $eventos = Evento::where('nombre', 'LIKE', '%'.$search.'%')->get();
      return json_encode($eventos);
    }

    public function searchArea($search)
    {
      $actividades = Actividad::where('titulo', 'LIKE', '%'.$search.'%')->get();
      return json_encode($actividades);
    }

    public function searchTipo($search)
    {
      $tipos = TipoActividad::where('nombre', 'LIKE', '%'.$search.'%')->get();
      return json_encode($tipos->actividades);
    }

}
