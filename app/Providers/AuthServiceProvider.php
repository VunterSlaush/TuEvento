<?php

namespace App\Providers;

use App\Evento;
use App\Actividad;
use App\Propuesta;
use App\Policies\EventoPolicy;
use App\Policies\ActividadPolicy;
use App\Policies\PropuestaPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Evento::class => EventoPolicy::class,
        Actividad::class => ActividadPolicy::class,
        Propuesta::class => PropuestaPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
