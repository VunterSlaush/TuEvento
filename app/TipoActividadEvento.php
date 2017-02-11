<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoActividadEvento extends Model
{
  protected $table = "tipo_actividad_evento";

  protected $fillable = ['id','id_tipo','id_evento'];

  public function tipoActividad(){
    return $this->belongsTo('App\TipoActividad','id_tipo');
  }

  public function evento(){
    return $this->belongsTo('App\Evento','id_evento');
  }
}
