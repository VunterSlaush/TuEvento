<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use View;
use App\Actividad;


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

}
