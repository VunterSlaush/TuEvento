<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CertificadoController extends Controller
{

	/*
    SELECT users.nombre,users.cedula,id_actividad,fecha,titulo,evento.nombre as nombre_evento, lugar
    FROM asiste
    INNER JOIN actividad
    ON asiste.id_actividad=actividad.id
    INNER JOIN users
    ON asiste.cedula = users.cedula
    INNER JOIN evento
    ON actividad.evento = evento.id
    WHERE users.cedula = '00000002';
    */

    public function generarCertificado()
    {
    	if(Auth::guest()){
        	
        	return redirect('/');
    	
    	}

      	$certificado = DB::table('asiste')
            ->select('asiste.cedula','id_actividad','fecha','titulo','hora_inicio','hora_fin','asistio','ponente','codigo')
            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
            ->join('users', 'asiste.cedula', '=', 'users.cedula')
            ->join('evento','actividad.evento','=','evento.id')
            ->where('asiste.cedula',Auth::id())
            ->where('asiste.asistio','=', true)
            ->where('asistio.codigo','=',codigoParam)
            ->get();
      	return $certificado;
    }

    public function getCertificado(){
    	
    	$certified = $this->generarCertificado();

    	$certificado = \PDF::loadview('certificado', ['certified' => $certified]);
    	return $certificado->download('certificate.pdf');

    }

    public function verCertificados(){
    	
    	//$certificado = \PDF::loadview('certificado');
    	$certificado = DB::table('asiste')
            ->select('asiste.cedula','id_actividad','fecha','titulo','hora_inicio','hora_fin','asistio','ponente','codigo')
            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
            ->join('users', 'asiste.cedula', '=', 'users.cedula')
            ->join('evento','actividad.evento','=','evento.id')
            ->where('asiste.cedula',Auth::id())
            ->where('asiste.asistio','=', true)
            ->get();
        return $certificado;

    }
}
