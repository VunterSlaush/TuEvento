<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = "evento";

    protected $fillable = ['id',
    					'creador',
    					'nombre',
    					'lugar',
    					'fecha_inicio',
    					'fecha_fin',
    					'cant_max_actividades',
    					'punt_min_aprobatorio',
    					'estado',
    					'created_at',
    					'updated_at'];

   	public function actividades(){

    	return $this->hasMany('App\Actividad','id_evento');

    }

    public function propuestas(){

    	return $this->hasMany('App\Propuesta','id_evento');

    }

    public function comites(){

    	return $this->hasMany('App\Comite','id_evento');

    }

    public function user(){

    	return $this->belongsTo('App\User','creador','cedula');

    }
}
