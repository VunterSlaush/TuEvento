<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoActividadActividad extends Model
{
  protected $table = "tipo_actividad_actividad";

  protected $fillable = ['id','id_tipo','id_actividad'];

  public function tipoActividad(){
    return $this->belongsTo('App\TipoActividad','id_tipo');
  }

  public function actividad(){
    return $this->belongsTo('App\Actividad','id_actividad');
  }
}
