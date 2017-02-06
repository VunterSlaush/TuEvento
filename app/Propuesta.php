<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
    protected $table = "propuesta";

    protected $fillable = ['id',
    					'autor',
    					'id_evento',
    					'titulo',
    					'adjunto',
    					'demanda',
    					'descripcion',
    					'duracion',
    					'created_at',
    					'updated_at'];

    public function evento(){

    	return $this->belongsTo('App\Evento','id');

    }

    public function calificas(){

    	return $this->hasMany('App\Califica','id_propuesta');

    }

    public function user(){

    	return $this->belongsTo('App\User','autor');

    }
}
