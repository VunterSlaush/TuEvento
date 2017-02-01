<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asiste extends Model
{
    protected $table = "asiste";

    protected $fillable = ['cedula',
    					'id_actividad',
    					'codigo',
    					'created_at',
    					'updated_at'];

    public function user(){

    	return $this->belongsTo('App\User','cedula');

    }

    public function actividades(){

    	return $this->belongsTo('App\Actividad','id_actividad');

    }
}
