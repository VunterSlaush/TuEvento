<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $table = "tipo_actividad";

    protected $fillable = ['id','nombre'];

    public function tipoActividadEvento(){
    	return $this->hasMany('App\TipoActividadEvento','id_tipo');
    }

    public function actividades(){
    	return $this->hasMany('App\Actividad','tipo');
    }

    public function setNombreAttribute($value){
    	$this->attributes['nombre'] = ucfirst(strtolower($value));
  	}

  	public function getNombreAttribute($value){
    	return ucfirst(strtoupper($value));
  	}
}
