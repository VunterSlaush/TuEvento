@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2">
          <ul class="collection with-header">
            <li class="collection-header"> <h5> Dashboard </h5> </li>
          </ul>
          <ul class="collapsible popout" data-collapsible="accordion">
            <li>
              <div class="collapsible-header active"> Eventos </div>
              <div class="collapsible-body">
                <ul class="collection">
                  <a href="{{ url('/misEventos') }}" class="collection-item"> Mis Eventos</a>
                  <a href="{{ url('/evento') }}" class="collection-item"> Ver todos</a>
                  <a href="{{ url('/evento/create') }}" class="collection-item"> Crear Evento</a>
                </ul>
              </div>
            </li>
            <li>
              <div class="collapsible-header"> Actividades </div>
              <div class="collapsible-body">
                <ul class="collection">
                  <a href="{{ url('/misActividades') }}" class="collection-item"> Mis Actividades</a>
                  <a href="{{ url('/actividad') }}" class="collection-item"> Ver todas</a>
                </ul>
              </div>
            </li>
            <li>
              <div class="collapsible-header"> Propuestas </div>
              <div class="collapsible-body">
                <ul class="collection">
                  <a href="{{ url('/propuesta') }}" class="collection-item"> Mis Propuestas</a>
                </ul>
              </div>
            </li>
          </ul>
        </div>
    </div>
</div>
@endsection
