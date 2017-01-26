<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

        return $this->belongsTo('App\Evento');

    }

    public function propuestas(){

        return $this->hasMany('App\Propuesta');

    }

    public function asistes(){

        return $this->hasMany('App\Asiste');

    }

    public function actividades(){

        return $this->hasMany('App\Actividad');

    }

    public function calificas(){

        return $this->hasMany('App\Califica');

    }

    public function comites(){

        return $this->hasMany('App\Comite');

    }
}
