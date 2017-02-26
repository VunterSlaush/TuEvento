<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asiste extends Model
{
    protected $primaryKey = 'codigo';
    protected $table = "asiste";

    protected $fillable = [ 'codigo',
              'cedula',
    					'id_actividad',
              'asistio',
    					'created_at',
    					'updated_at'];

    public function user(){

    	return $this->belongsTo('App\User','cedula','cedula');

    }

    public function actividad(){

    	return $this->belongsTo('App\Actividad','id_actvidad','id');

    }
}
