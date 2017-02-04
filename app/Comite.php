<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    protected $primaryKey = 'id';
    protected $table = "comite";

    protected $fillable = ['cedula',
    					'id_evento',
    					'created_at',
    					'updated_at'];

    public function evento(){

    	return $this->belongsTo('App\Evento','id_evento');

    }

    public function user(){

    	return $this->belongsTo('App\User','cedula');

    }
}
