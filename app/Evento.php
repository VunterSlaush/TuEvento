<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = "evento";

    protected $fillable = [
    					'creador',
    					'nombre',
    					'lugar',
    					'fecha_inicio',
    					'fecha_fin',
    					'estado',
              'certificado_por_actividad',
    					'created_at',
    					'updated_at'];

   	public function actividades(){

    	return $this->hasMany('App\Actividad','id_evento','id');

    }

    public function propuestas(){

    	return $this->hasMany('App\Propuesta','id_evento','id');

    }

    public function comites(){

    	return $this->hasMany('App\Comite','id_evento','id');

    }

    public function jurados(){

      return $this->hasMany('App\Jurado','id_evento','id');

    }

    public function user(){

    	return $this->belongsTo('App\User','creador','cedula');

    }

    public function tipoActividad(){

    	return $this->hasMany('App\TipoActividadEvento','id_evento');

    }

    public function areas(){

    	return $this->hasMany('App\Area','id_evento');

    }
}
