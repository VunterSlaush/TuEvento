<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Encuesta extends Model
{
    protected $table = "encuesta";
    protected $fillable = ['tipo','nombre','id_evento'];

    public function preguntas()
    {
        return $this->hasMany('App\EncuestaPregunta','id_encuesta','id');
    }

    public function evaluacion()
    {
        return $this->belongsTo('App\Evalua','id_encuesta','id');
    }

    public function calificacion()
    {
        return $this->hasOne('App\Califica','id_encuesta','id');
    }
}
