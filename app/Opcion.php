<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Opcion extends Model
{
    protected $table = "opcion";
    protected $fillable = [
                        'id_pregunta',
                        'opcion',
                        'valor'];

    public function pregunta(){
        return $this->belongsTo('App\Pregunta','id','id_pregunta');
    }

    public function respuestas()
    {
        return $this->hasMany('App\Respuesta','id_opcion');
    }
}
