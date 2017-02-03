<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use View;


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

    public function generarSingleCertificado()
    {
    	if(Auth::guest()){
        	
        	return redirect('/');
    	
    	}

      	$certificado = DB::table('asiste')
            ->select('users.nombre','users.cedula','id_actividad','fecha','titulo','evento.nombre AS nombre_evento','lugar')
            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
            ->join('users', 'asiste.cedula', '=', 'users.cedula')
            ->join('evento','actividad.evento','=','evento.id')
            //->where('asiste.cedula',Auth::id()) usable only when a user is logged in, not usable for initial tests.
            ->where('asiste.cedula','=','00000003') //only usable for tests, this value can be changed.
            ->where('asiste.asistio','=', true)
            //->where('asistio.codigo','=',codigoParam)
            ->get();
      	return $certificado;
    }


    public function generarMultipleCertificados(){
        
        //$certificado = \PDF::loadview('certificado');
        $certificado = DB::table('asiste')
            ->select('users.nombre','users.cedula','id_actividad','fecha','titulo','evento.nombre AS nombre_evento','lugar')
            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
            ->join('users', 'asiste.cedula', '=', 'users.cedula')
            ->join('evento','actividad.evento','=','evento.id')
            //->where('asiste.cedula',Auth::id()) usable only when a user is logged in, not usable for initial tests.
            ->where('asiste.cedula','=','00000002') //only usable for tests, this value can be changed.
            //->where('asiste.asistio','=', true)            
            ->get();
        return $certificado;

    }


    public function getSingleCertificado(){
    	    
        $certificate = $this->generarSingleCertificado();
    
    	$certificado = \PDF::loadview('certificado',['certificate' => $certificate]);
    	return $certificado->setPaper('a4','landscape')->stream('certificate.pdf');

    }


    public function getMultipleCertificado(){
        
        $certified = $this->generarMultipleCertificados();

        return View::make('listaCertificados', ['certified' => $certified]);
        

    }

}
