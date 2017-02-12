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

  public function update(User $user, Evento $evento)
  {
      $esCreador = $user->id === $evento->creador;
      $esComite = false;
      foreach ($evento->comites as $comite)
      {
        if($comite->user->id === $user->id)
          $esComite = true;
      }
      return $esCreador || $esComite;
  }
}
