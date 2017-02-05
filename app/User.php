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
        'nombre', 'email', 'password','cedula',
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

        return $this->hasOne('App\Evento','creador');

    }

    public function propuestas(){

        return $this->hasMany('App\Propuesta','autor');

    }

    public function asistes(){

        return $this->hasMany('App\Asiste','cedula');

    }

    public function actividades(){

        return $this->hasMany('App\Actividad','ponente');

    }

    public function calificas(){

        return $this->hasMany('App\Califica','cedula');

    }

    public function comites(){

        return $this->hasMany('App\Comite','cedula');

    }
}
