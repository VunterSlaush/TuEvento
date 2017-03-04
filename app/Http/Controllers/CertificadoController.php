<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use View;


class CertificadoController extends Controller
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
	            ->select('evento.nombre as evento','asiste.cedula as cedula', 'lugar','imagen','user.nombre as nombre','id_actividad','fecha','titulo','asistio','ponente.nombre as ponente','codigo')
	            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
	            ->join('users as user', 'asiste.cedula', '=', 'user.cedula')
							->join('users as ponente', 'actividad.id_user', '=', 'ponente.cedula')
	            ->join('evento','actividad.id_evento','=','evento.id')
	            ->where('asiste.cedula',Auth::id())
	            ->where('asiste.asistio','=', true)
							->where('asiste.codigo', '=',$codigo)
	            ->first();
      	return $certificado;
    }

		public function generarCertificadoEvento($evento, $cedula)
		{
			$certificado = DB::table('evento')
											->select('evento.id as evento_id','evento.nombre as evento', 'lugar', 'imagen', 'fecha_inicio as fecha', 'users.cedula as cedula', 'users.nombre as nombre')
											->join('actividad', 'actividad.id_evento', '=', 'evento.id')
											->join('asiste', 'actividad.id','=','asiste.id_actividad')
											->join('users', 'users.cedula','=','asiste.cedula')
											->where('certificado_por_actividad','=',false)
											->where('asiste.asistio','=',true)
											->where('asiste.cedula','=',$cedula)
											->where('evento.id','=',$evento)
											->groupBy('evento.nombre')
											->groupBy('evento.id')
											->groupBy('lugar')
											->groupBy('imagen')
											->groupBy('fecha_inicio')
											->groupBy('users.cedula')->first();
				//TODO a;adir redireccion si esta consulta viene vacia!
				return $certificado;
		}

    public function verCertificados()
		{

    	//$certificado = \PDF::loadview('certificado');
    	$certificados_por_evento = $this->certificadosPorEvento();
			$certificados_por_actividad = $this->certificadosPorActividad();

				return view('certificados',['certificados_evento' => $certificados_por_evento,
																		'certificados_actividad' => $certificados_por_actividad]);
		}

    public function getCertificado($codigo){

        if(Auth::guest()){

            return redirect('home');

        }else{

            $certificate = $this->generarCertificado($codigo);

						if ($certificate->imagen != ''){
							$img_path = Storage::url($certificate->imagen);
							$img_url = url($img_path);
								$certificate->imagen = $img_url;
						}

            $certificado = \PDF::loadview('certificado',['certificate' => $certificate]);
            return $certificado->setPaper('a4','landscape')->stream('certificate.pdf');
        }

    }

		public function getCertificadoEvento($cedula, $evento){

				if(Auth::guest()){

						return redirect('home');

				}else{

						if ($certificate->imagen != ''){
							$img_path = Storage::url($certificate->imagen);
							$img_url = url($img_path);
								$certificate->imagen = $img_url;
						}

						$certificado = \PDF::loadview('certificado',['certificate' => $certificate]);
						return $certificado->setPaper('a4','landscape')->stream('certificate.pdf');
				}

		}

	//return view('actividad.index',['actividad' => $actividad]);

		/*
		SELECT evento.nombre as evento, lugar, imagen, fecha_inicio, fecha_fin, asistidor.cedula, asistidor.nombre as nombre_user FROM evento
		INNER JOIN actividad ON (actividad.id_evento = evento.id)
		INNER JOIN asiste ON (actividad.id = asiste.id_actividad)
		INNER JOIN users as asistidor ON (asistidor.cedula = asiste.cedula)
		WHERE certificado_por_actividad = false AND asiste.asistio = true
		GROUP BY evento.nombre, lugar,imagen, fecha_inicio, fecha_fin,asistidor.cedula;
		*/
		public function certificadosPorEvento()
		{
			$certificados = DB::table('evento')
											->select('evento.id as id_evento','evento.nombre as evento', 'lugar', 'imagen', 'fecha_inicio as fecha', 'users.cedula as cedula', 'users.nombre as nombre')
											->join('actividad', 'actividad.id_evento', '=', 'evento.id')
											->join('asiste', 'actividad.id','=','asiste.id_actividad')
											->join('users', 'users.cedula','=','asiste.cedula')
											->where('certificado_por_actividad','=',false)
											->where('asiste.asistio','=',true)
											->where('asiste.cedula','=',Auth::id())
											->groupBy('evento.nombre')
											->groupBy('evento.id')
											->groupBy('lugar')
											->groupBy('imagen')
											->groupBy('fecha_inicio')
											->groupBy('users.cedula')->get();
				return $certificados;
		}

		public function certificadosPorActividad()
		{
			$certificados = DB::table('asiste')
					            ->select('evento.nombre as evento','asiste.id_actividad','fecha','titulo','asistio','ponente.nombre as ponente','codigo')
					            ->join('actividad', 'asiste.id_actividad', '=', 'actividad.id')
					            ->join('users as user', 'asiste.cedula', '=', 'user.cedula')
											->join('users as ponente', 'actividad.id_user', '=', 'ponente.cedula')
					            ->join('evento','actividad.id_evento','=','evento.id')
					            ->where('asiste.cedula',Auth::id())
					            ->where('asiste.asistio','=', true)
											->where('evento.certificado_por_actividad','=',true)
					            ->get();

			return $certificados;
		}

}
