<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Asiste;
use App\User;
use Illuminate\Support\Facades\Auth;

class AsisteController extends ActividadController
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

    public function mi_horario()
    {
        return $this->generarHorario();
    }

    public function destroy($id)
    {
      Asiste::find($id)->delete();
      return json_encode(["success" => true]);
      //return redirect('/miHorario')->with('success','actividad eliminada');
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
      try{
        $asistencias = DB::table('asiste')
              ->select('asiste.codigo as id','asiste.cedula','asiste.id_actividad','fecha','titulo','hora_inicio','hora_fin','asistio','ponente.nombre AS ponente')
              ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
              ->join('users as user', 'asiste.cedula', '=', 'user.cedula')
              ->join('users as ponente', 'actividad.id_user', '=', 'ponente.cedula')
              ->where('asiste.cedula',Auth::id())
              ->where('asiste.asistio',false)
              ->get();
      } catch (\Illuminate\Database\QueryException $qe) {
        return redirect()->back()->withErrors(['Error al generar horario']);
      }

      return view('horario',['horario' => $asistencias]);
    }

    public function marcarAsistencia(Request $request)
    {
      $actividad = $request->input('id_actividad');
      $cedula = $request->input('cedula');
      //<!--TODO si la asistencia no existe crear una nueva ! con asistio = true
      $asistencia = Asiste::where([['id_actividad','=',$actividad],['cedula','=',$cedula]])->first();
      if($asistencia != null)
      {
        $asistencia->asistio = true;
        $asistencia->save();
        return json_encode(["asistencia"=> $asistencia, "success" => true]);
      }
      else
      {
        if(User::where('cedula',$cedula)->first() != null)
        {
          $asistencia = $this->createAsistencia($actividad,$cedula);
          $asistencia->asistio = true;
          $asistencia->save();
          return json_encode(["asistencia"=> $asistencia, "success" => true, "msg" => "asistencia creada y marcada"]);
        }
        else
          return json_encode(["error" =>"usuario no registrado", "success" => false]);
      }


    }

    /*
    Query para obtener la lista de asistentes a una actividad

    SELECT users.nombre,users.cedula,users.email,asiste.asistio, actividad.titulo
    FROM users 
    INNER JOIN asiste 
    ON users.cedula = asiste.cedula AND asiste.id_actividad = 1
    INNER JOIN actividad
    ON actividad.id = asiste.id_actividad
    ORDER BY asiste.asistio DESC;

    */

    public function getAsistencia($id_actividad){
      
      if(Auth::guest()){
        return redirect('/');
      }

      $asistentes = DB::table('users')
      ->select('users.nombre as nombre','users.cedula as cedula','users.email as email', 'asiste.asistio as asistio','actividad.titulo as titulo')
      ->join('asiste','users.cedula','=','asiste.cedula')
      ->where('asiste.id_actividad','=',$id_actividad)
      ->join('actividad','actividad.id','=','asiste.id_actividad')
      ->orderBy('asiste.asistio', 'desc')
      ->get();

      return $asistentes;

    }

    public function getTitulo($id_actividad){
      $titulo = DB::table('actividad')
      ->select('actividad.titulo as titulo')      
      ->where('actividad.id','=',$id_actividad)      
      ->first();

      return $titulo;      
    }

    public function descargarAsistencia($id_actividad){

      if(Auth::guest()){

            return redirect('home');

        }else{

            $asistencia = $this->getAsistencia($id_actividad);
            $titulo = $this->getTitulo($id_actividad);

            $asistentes = \PDF::loadview('asistencia',['asistencia' => $asistencia, 'title' => $titulo]);
            return $asistentes->setPaper('a4')->stream('asistencia.pdf');
        }
      
    }

    public function verAsistencia($id_actividad){

      if(Auth::guest()){

            return redirect('home');

        }else{

            $asistencia = $this->getAsistencia($id_actividad);

            return view('verAsistencia',['asistencia' => $asistencia]);
            
        }
      
    }
}
