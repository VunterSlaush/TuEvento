<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use View;
use App\Actividad;
use App\Evento;


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

    public function searchActivities(Request $request){

      $busqueda = $request->input('titulo');

      $actividades = Actividad::where('titulo','=',$busqueda)->get();

      return view('search-activities',['actividades' => $actividades]);

    }
    //TODO Realizar mejor la Consulta! Buscar Las actividades de un eventos
    // Las Actividades de un Area, Las Actividades de un tipo
    public function searchAll($search)
    {
      $eventos = Evento::where('nombre', 'LIKE', '%'.$search.'%')->get();
      return json_encode($eventos);
    }

}
