<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = "actividad";

    protected $fillable = ['id',
    					'ponente',
                        'evento',
    					'fecha',
    					'titulo',
    					'hora_inicio',
    					'hora_fin',
    					'resumen',
    					'created_at',
    					'updated_at'];

    public function evento(){

        return $this->belongsTo('App\Evento');

    }

    public function user(){

        return $this->belongsTo('App\User');

    }

    public function asiste(){

        return $this->belongsTo('App\Asiste');

    }
}