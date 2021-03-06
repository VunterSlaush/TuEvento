<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Califica extends Model
{
    protected $primaryKey = 'id';
    protected $table = "califica_satisfaccion";

    protected $fillable = [
    					'id_actividad',
              'id_encuesta',
    					'id_user',
    					'created_at',
    					'updated_at'];

    public function actividad(){

    	return $this->belongsTo('App\Actividad','id','id_actividad');

    }

    public function user(){

    	return $this->belongsTo('App\User','cedula','id_user');

    }

    public function encuesta()
    {
      return $this->belongsTo('App\User','id','id_encuesta');
    }
}
