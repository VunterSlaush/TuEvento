<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaJurado extends Model
{
  protected $table = "area_jurado";

  protected $fillable = [
            'id_area',
            'id_jurado'
          ];

  public function area(){
    return $this->belongsTo('App\Area','id_area');
  }

  public function jurado(){
    return $this->belongsTo('App\Jurado','id_jurado');
  }
}
