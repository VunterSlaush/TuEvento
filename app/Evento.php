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

    	return $this->hasMany('App\Actividad');

    }

    public function propuestas(){

    	return $this->hasMany('App\Propuesta','idEvento');

    }

    public function comites(){

    	return $this->hasMany('App\Comite','idEvento');

    }

    public function users(){

    	return $this->hasMany('App\User','cedula');

    }
}
