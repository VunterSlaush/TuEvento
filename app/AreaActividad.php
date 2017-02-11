<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaActividad extends Model
{
  protected $table = "area_actividad";

  protected $fillable = [
            'id',
            'id_area',
            'id_actividad'
          ];

  public function area(){
    return $this->belongsTo('App\Area','id_area');
  }

  public function evento(){
    return $this->belongsTo('App\Evento','id_actividad');
  }
}
