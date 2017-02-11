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

    public function tipoActividadActividad(){
    	return $this->hasMany('App\TipoActividadActividad','id_tipo');
    }
}
