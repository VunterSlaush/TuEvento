<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
  protected $table = "respuesta_pregunta";

  protected $fillable = ['id_opcion','id_evalua', 'id_califica', 'tipo'];

}
