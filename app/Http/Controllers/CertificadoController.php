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

    public function generarCertificado($codigo)
    {
    	if(Auth::guest()){

        	return redirect('/');

    	}

      	$certificado = DB::table('asiste')
	            ->select('evento.nombre as evento','asiste.cedula as cedula', 'lugar','user.nombre as nombre','id_actividad','fecha','titulo','asistio','ponente.nombre as ponente','codigo')
	            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
	            ->join('users as user', 'asiste.cedula', '=', 'user.cedula')
							->join('users as ponente', 'actividad.ponente', '=', 'ponente.cedula')
	            ->join('evento','actividad.id_evento','=','evento.id')
	            ->where('asiste.cedula',Auth::id())
	            ->where('asiste.asistio','=', true)
							->where('asiste.codigo', '=',$codigo)
	            ->first();
      	return $certificado;
    }

    public function verCertificados()
		{

    	//$certificado = \PDF::loadview('certificado');
    	$certificado = DB::table('asiste')
            ->select('evento.nombre as evento','id_actividad','fecha','titulo','asistio','ponente.nombre as ponente','codigo')
            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
            ->join('users as user', 'asiste.cedula', '=', 'user.cedula')
						->join('users as ponente', 'actividad.ponente', '=', 'ponente.cedula')
            ->join('evento','actividad.id_evento','=','evento.id')
            ->where('asiste.cedula',Auth::id())
            ->where('asiste.asistio','=', true)
            ->get();

				return view('certificados',['certificados' => $certificado]);
		}

    public function getCertificado($codigo){

        if(Auth::guest()){

            return redirect('home');

        }else{

            $certificate = $this->generarCertificado($codigo);
            $certificado = \PDF::loadview('certificado',['certificate' => $certificate]);
            return $certificado->setPaper('a4','landscape')->stream('certificate.pdf');

        }


    }


}
