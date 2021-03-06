<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
    protected $table = "propuesta";

    protected $fillable = [
    					'autor',
    					'id_evento',
    					'titulo',
              'id_area',
              'id_tipo',
    					'adjunto',
    					'demanda',
    					'descripcion',
    					'created_at',
    					'updated_at'];

    public function evento(){

    	return $this->belongsTo('App\Evento','id_evento','id');

    }
    /*TODO ADD EVALUACIONES */

    public function user(){

    	return $this->belongsTo('App\User','autor','cedula');
    }

    public function area()
    {
      return $this->belongsTo('App\Area','id','id_area');
    }

    public function tipo()
    {
      return $this->belongsTo('App\TipoActividad','id_tipo');
    }

    public function evaluaciones()
    {
      return $this->hasMany('App\Evalua','id_propuesta','id');
    }
}
