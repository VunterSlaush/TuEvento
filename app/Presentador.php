<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentador extends Model
{
  protected $table = "presentador";

  protected $fillable = [
            'id_actividad',
            'id_user',
            'created_at',
            'updated_at'];


  public function actividad()
  {

    return $this->belongsTo('App\Evento','id','id_actividad');

  }

  public function user()
  {

    return $this->belongsTo('App\User','cedula','id_user');

  }
}
