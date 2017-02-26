<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaEvento extends Model
{
  protected $table = "area_evento";

  protected $fillable = [
            'id',
            'id_area',
            'id_evento'
          ];

  public function area(){
    return $this->belongsTo('App\Area','id_area');
  }

  public function evento(){
    return $this->belongsTo('App\Evento','id_evento');
  }
}
