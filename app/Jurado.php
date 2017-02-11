<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurado extends Model
{
    protected $table = "jurado";

    protected $fillable = [
              'id_evento',
              'id_user',
    					'created_at',
    					'updated_at'];


    public function evento()
    {

      return $this->belongsTo('App\Evento','id','id_evento');

    }

    public function user()
    {

      return $this->belongsTo('App\User','cedula','id_user');

    }

}
