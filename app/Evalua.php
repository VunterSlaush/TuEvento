<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Evalua extends Model
{
    protected $table = "evalua";
    protected $fillable = ['id',
                        'cedula',
                        'id_propuesta',
                        'id_encuesta'];

    public function user()
    {
        return $this->belongsTo('App\User','cedula','cedula');
    }
    public function propuesta()
    {
        return $this->belongsTo('App\Propuesta','id','id_propuesta');
    }
    public function encuesta(){
        return $this->hasOne('App\Encuesta','id','id_encuesta');
    }


}
