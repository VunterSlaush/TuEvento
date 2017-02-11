<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Pregunta extends Model
{
    protected $table = "pregunta";
    protected $fillable = [
                        'id_encuesta',
                        'pregunta'];

    public function encuesta()
    {
        return $this->belongsTo('App\Encuesta','id','id_encuesta');
    }

    public function opciones()
    {
      return $this->hasMany('App\Pregunta','id_pregunta','id');
    }
}
