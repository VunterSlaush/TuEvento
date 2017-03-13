<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
  protected $table = "respuesta_pregunta";

  protected $fillable = ['id_opcion','id_evalua', 'id_califica', 'tipo'];

  public function evalua()
  {
      return $this->belongsTo('App\Evalua','id_evalua');
  }

  public function opcion()
  {
    return $this->hasOne('App\Opcion','id','id_opcion');
  }

}
