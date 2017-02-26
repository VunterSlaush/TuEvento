<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'cedula';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password','cedula','organizacion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function evento(){

        return $this->hasMany('App\Evento','creador','cedula');

    }

    public function propuestas(){

        return $this->hasMany('App\Propuesta','autor','cedula');

    }

    public function asistencias(){

        return $this->hasMany('App\Asiste','cedula','cedula');

    }

    public function actividades(){

        return $this->hasMany('App\Actividad','ponente','cedula');

    }

    public function calificaciones(){

        return $this->hasMany('App\Califica','id_user','cedula');

    }

    public function comites(){

        return $this->hasMany('App\Comite','id_user','cedula');

    }

    public function jurado()
    {
        return $this->hasMany('App\Jurado','id_user','cedula');
    }

    public function presentadores(){

        return $this->hasMany('App\Presentador','id_user','cedula');

    }

    public function evaluaciones()
    {
        return $this->hasMany('App\Evalua','cedula','cedula');
    }
}
