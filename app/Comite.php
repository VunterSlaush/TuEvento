<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    protected $table = "comite";

    protected $fillable = ['cedula',
    					'idEvento',
    					'created_at',
    					'updated_at'];

    public function evento(){

    	return $this->belongsTo('App\Evento','idEvento');

    }

    public function user(){

    	return $this->belongsTo('App\User','cedula');

    }
}
