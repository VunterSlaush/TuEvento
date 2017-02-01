<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsisteController extends Controller
{
    public function mi_horario()
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        return $this->generarHorario();
      }
    }
    /*
    //ESTA FUNCION GENERA EL HORARIO DEL USUARIO!
    SELECT users.cedula,id_actividad,fecha,titulo,hora_inicio,hora_fin,asistio
    FROM asiste
    INNER JOIN actividad
    ON asiste.id_actividad=actividad.id
    INNER JOIN users
    ON asiste.cedula = users.cedula
    WHERE users.cedula = id;

    */
    public function generarHorario()
    {
      $asistencias = DB::table('asiste')
            ->select('asiste.cedula','id_actividad','fecha','titulo','hora_inicio','hora_fin','asistio','ponente')
            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
            ->join('users', 'asiste.cedula', '=', 'users.cedula')
            ->where('asiste.cedula',Auth::id())
            ->get();
      return $asistencias;
    }
}
