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
      // TODO, A;adir la parte del Area!!
      $search = strtolower($search);
      $actividades = DB::table('actividad')->whereRaw("lower(titulo) LIKE '%".$search."%'")->
        orWhereRaw("to_char(fecha,'DD-MM-YYYY') LIKE '%".str_replace("/", "-", $search)."%'")->
        orWhereRaw("to_char(fecha,'YYYY-MM-DD') LIKE '%".str_replace("/", "-", $search)."%'")->limit(50)->get();

      $actividades_tipo = DB::table('actividad')
                    ->select('actividad.*')
                    ->join('tipo_actividad', 'tipo_actividad.id', '=', 'actividad.tipo')
                    ->whereRaw("lower(tipo_actividad.nombre) LIKE '%".$search."%'")
                    ->limit(50)
                    ->get();



      return json_encode($this->mergeCollections($actividades,$actividades_tipo));

    }

    public function searchUsers($param)
    {
      $param = strtolower($param);
      $users = DB::table('users')->select('nombre','cedula')->whereRaw("lower(users.nombre) LIKE '%".$param."%'")->
                                   orWhereRaw("users.cedula LIKE '%".$param."%'")->get();
      return json_encode(['results' => $users]);
    }

    public function searchUsersNoAsistentes($param, $actividad)
    {
      $param = strtolower($param);
      $users = DB::table('users')->select('nombre','cedula')
                                  ->whereRaw("lower(users.nombre) LIKE '%".$param."%'")
                                  ->orWhereRaw("users.cedula LIKE '%".$param."%'")
                                  ->get();
      $asistencias = DB::table('asiste')->where('id_actividad',$actividad)->get();
      $this->removeUsersWithAsist($users,$asistencias);
      return json_encode(['results' => $users]);
    }

    public function removeUsersWithAsist($users, $asists)
    {
      foreach ($asists as $key => $asist)
      {
        foreach ($users as $userKey => $value) {
            if($value->cedula == $asist->cedula || $value->cedula == $asist->id_user)
              $users->forget($userKey);
        }
      }
    }

    public function searchUsersNoPresentadores($param,$actividad)
    {
      $param = strtolower($param);
      $users = DB::table('users')->select('nombre','cedula')
                                  ->whereRaw("lower(users.nombre) LIKE '%".$param."%'")
                                  ->orWhereRaw("users.cedula LIKE '%".$param."%'")
                                  ->get();
      $asistencias = DB::table('presentador')->where('id_actividad',$actividad)->get();
      $this->removeUsersWithAsist($users,$asistencias);
      return json_encode(['results' => $users]);
    }

    public function searchUsersNoJurado($param,$evento)
    {
      $param = strtolower($param);
      $users = DB::table('users')->select('nombre','cedula')
                                  ->whereRaw("lower(users.nombre) LIKE '%".$param."%'")
                                  ->orWhereRaw("users.cedula LIKE '%".$param."%'")
                                  ->get();
      $jurados = DB::table('jurado')->where('id_evento',$evento)->get();
      $this->removeUsersWithAsist($users,$jurados);
      return json_encode(['results' => $users]);
    }

    public function searchUsersNoComite($param,$evento)
    {
      $param = strtolower($param);
      $users = DB::table('users')->select('nombre','cedula')
                                  ->whereRaw("lower(users.nombre) LIKE '%".$param."%'")
                                  ->orWhereRaw("users.cedula LIKE '%".$param."%'")
                                  ->get();
      $comites = DB::table('comite')->where('id_evento',$evento)->get();
      $this->removeUsersWithAsist($users,$comites);
      return json_encode(['results' => $users]);
    }

    public function searchEvento($search)
    {
      $search = strtolower($search);
      $eventos = Evento::whereRaw("lower(nombre) LIKE '%".$search."%'")->
                orWhereRaw("lower(lugar) LIKE '%".$search."%'")->
                orWhereRaw("to_char(fecha_inicio,'DD-MM-YYYY') LIKE '%".str_replace("/", "-", $search)."%'")->
                orWhereRaw("to_char(fecha_fin,'DD-MM-YYYY') LIKE '%".str_replace("/", "-", $search)."%'")->
                orWhereRaw("to_char(fecha_fin,'YYYY-MM-DD') LIKE '%".str_replace("/", "-", $search)."%'")->
                orWhereRaw("to_char(fecha_inicio,'YYYY-MM-DD') LIKE '%".str_replace("/", "-", $search)."%'")->limit(35)->get();

      $eventos_area = DB::table('evento')
                      ->select('evento.*')
                      ->join('area_evento','area_evento.id_evento','=','evento.id')
                      ->join('area','area_evento.id_area','=','area.id')
                      ->whereRaw("lower(area.nombre) LIKE '%".$search."%'")
                      ->groupBy('evento.id')->limit(35)->get();

      $eventos_tipo = DB::table('evento')
                      ->select('evento.*')
                      ->join('tipo_actividad_evento','tipo_actividad_evento.id_evento','=','evento.id')
                      ->join('tipo_actividad','tipo_actividad_evento.id_tipo','=','tipo_actividad.id')
                      ->whereRaw("lower(tipo_actividad.nombre) LIKE '%".$search."%'")
                      ->groupBy('evento.id')->limit(35)->get();


      return json_encode($this->mergeCollections($this->mergeCollections($eventos,$eventos_area),$eventos_tipo));
    }

    private function mergeCollections($jsonArray1, $jsonArray2)
    {
        for ($i=0; $i < count($jsonArray2) ; $i++)
        {
          if(!$this->existeIdEnCollection($jsonArray1,$jsonArray2[$i]->id))
            $jsonArray1->push($jsonArray2[$i]);
        }
        return $jsonArray1;
    }

    private function existeIdEnCollection($jsonArray,$id)
    {
      for ($i=0; $i < count($jsonArray) ; $i++)
      {
          if($jsonArray[$i]->id == $id)
            return true;
      }
      return false;
    }

}
