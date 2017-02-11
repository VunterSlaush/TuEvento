<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asiste extends Model
{
    protected $primaryKey = 'id';
    protected $table = "asiste";

    protected $fillable = ['cedula',
    					'id_actividad',
    					'codigo',
              'asistio',
    					'created_at',
    					'updated_at'];

    public function user(){

    	return $this->belongsTo('App\User','cedula','cedula');

    }

    public function actividad(){

    	return $this->belongsTo('App\Actividad','id','id_actividad');

    }
}
