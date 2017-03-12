<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
  protected $table = "area";

  protected $fillable = ['id','nombre'];

  public function areaEvento(){
    return $this->hasMany('App\AreaEvento','id_area');
  }

  public function areaActividad(){
    return $this->hasMany('App\AreaActividad','id_area');
  }

  public function areaJurado(){
    return $this->hasMany('App\AreaJurado','id_area');
  }

  public function setNombreAttribute($value){
    $this->attributes['nombre'] = ucfirst(strtolower($value));
  }

  public function getNombreAttribute($value){
    return ucfirst(strtolower($value));
  }

}
