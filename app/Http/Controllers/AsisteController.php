<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Asiste;
use Illuminate\Support\Facades\Auth;

class AsisteController extends Controller
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
      $ruta = "/actividad/" + $actividad + "/verificarAsistencia";
      if($asistencia != null)
      {
        $asistencia->asistio = true;
        $asistencia->save();
        return \Redirect::route('verificarAsistencia', $actividad)->with('success','Asistencia Marcada!');
      }
      else
      {
        //TODO agregar Error de que el user no existe!!
        return \Redirect::route('verificarAsistencia', $actividad);
      }


    }
}
