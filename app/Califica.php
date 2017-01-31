<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Califica extends Model
{
    protected $table = "califica";

    protected $fillable = ['cedula',
    					'idPropuesta',
    					'calificacion',
    					'created_at',
    					'updated_at'];

    public function propuesta(){

    	return $this->belongsTo('App\Propuesta','idPropuesta');

    }

    public function user(){

    	return $this->belongsTo('App\User','cedula');

    }
}
