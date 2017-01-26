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
    					'created_at',
    					'updated_at'];

   	public function actividades(){

    	return $this->hasMany('App\Actividad');

    }

    public function propuestas(){

    	return $this->hasMany('App\Propuesta');

    }

    public function comites(){

    	return $this->hasMany('App\Comite');

    }

    public function users(){

    	return $this->hasMany('App\User');

    }
}