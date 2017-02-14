<?php

namespace App\Policies;

use App\User;
use App\Actividad;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActividadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the actividad.
     *
     * @param  \App\User  $user
     * @param  \App\Actividad  $actividad
     * @return mixed
     */
     public function modify(User $user, Actividad $actividad)
     {
         return $user->cedula === $actividad->id_user;
     }

     public function attend(User $user, Actividad $actividad)
     {
       $asiste = false;
       foreach ($actividad->asistencias as $asistencia)
       {
         if($user->cedula === $asistencia->cedula)
           $asiste = true;
       }
       return $asiste;
     }
}
