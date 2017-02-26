<?php

namespace App\Policies;

use App\User;
use App\Evento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

  public function modify(User $user, Evento $evento)
  {
      $esCreador = $user->cedula=== $evento->creador;
      $esComite = false;
      foreach ($evento->comites as $comite)
      {
        if($comite->user->cedula === $user->cedula)
          $esComite = true;
      }
      return $esCreador || $esComite;
  }
}
