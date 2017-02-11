<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = "actividad";

    protected $fillable = ['id',
    					'ponente',
              'id_evento',
    					'fecha',
    					'titulo',
    					'hora_inicio',
    					'hora_fin',
    					'resumen',
    					'created_at',
    					'updated_at'];

    public function evento(){

        return $this->belongsTo('App\Evento','id','id_evento');

    }

    public function user(){

        return $this->belongsTo('App\User','cedula','ponente');

    }

    public function asistencias(){

        return $this->hasMany('App\Asiste','id_actividad','id');

    }
}
