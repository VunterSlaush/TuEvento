<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncuestaPregunta extends Model
{
  protected $table = "encuesta_pregunta";

  protected $fillable = [
            'id',
            'id_pregunta',
            'id_encuesta'
          ];

  public function encuesta(){
    return $this->belongsTo('App\Encuesta','id_encuesta');
  }

  public function pregunta(){
    return $this->belongsTo('App\Pregunta','id_pregunta');
  }
}
