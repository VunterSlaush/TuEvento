<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = "actividad";

    protected $fillable = [
    					'id_user',
              'id_evento',
    					'fecha',
    					'titulo',
    					'hora_inicio',
    					'hora_fin',
    					'resumen',
    					'created_at',
    					'updated_at'];

    public function evento(){

        return $this->belongsTo('App\Evento','id_evento');

    }

    public function user(){

        return $this->belongsTo('App\User','id_user','cedula');

    }

    public function asistencias(){

        return $this->hasMany('App\Asiste','id_actividad');

    }

    public function calificaciones(){

        return $this->hasMany('App\Califica','id_activida','id');

    }

    public function presentadores(){

        return $this->hasMany('App\Presentador','id_actividad','id');

    }

    public function tipoActividad(){

    	return $this->hasMany('App\TipoActividadActividad','id_actividad');

    }

    public function areas(){

    	return $this->hasMany('App\AreaActividad','id_actividad');

    }
}
