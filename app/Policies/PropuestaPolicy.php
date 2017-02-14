<?php

namespace App\Policies;

use App\User;
use App\Propuesta;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropuestaPolicy
{
    use HandlesAuthorization;

    public function modify(User $user, Propuesta $propuesta)
    {
        return $user->cedula === $propuesta->autor;
    }

    public function aprove(User $user, Propuesta $propuesta)
    {
      $esCreador = $user->cedula=== $propuesta->evento->creador;
      $esComite = false;
      foreach ($propuesta->evento->comites as $comite)
      {
        if($comite->user->cedula === $user->cedula)
          $esComite = true;
      }
      return $esCreador || $esComite;
    }
}
