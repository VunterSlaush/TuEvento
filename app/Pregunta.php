<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Pregunta extends Model
{
    protected $table = "pregunta";
    protected $fillable = ['id_evento','pregunta'];

    public function encuesta()
    {
      return $this->hasMany('App\EncuestaPregunta','id_pregunta','id');
    }

    public function opciones()
    {
      return $this->hasMany('App\Opcion','id_pregunta','id');
    }
}
