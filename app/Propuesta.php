<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
    protected $table = "propuesta";

    protected $fillable = ['id',
    					'autor',
    					'idEvento',
    					'adjunto',
    					'demanda',
    					'created_at',
    					'updated_at'];

    public function evento(){

    	return $this->belongsTo('App\Evento');

    }

    public function calificas(){

    	return $this->hasMany('App\Califica');

    }

    public function user(){

    	return $this->belongsTo('App\User');

    }
}
