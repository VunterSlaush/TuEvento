@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> {{$actividad->titulo}}</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3> Detalles</h3>
      <h4>  {{title_case($actividad->titulo)}}</h4>
    </div>
  </div>

  <div class="content-body">
    <div class="container">
      <ul class="collection with-header">
        <li class="collection-header"> <h4> {{$actividad->titulo}}</h4> </li>
        <li class="collection-item">
          <ul>
            <li> <strong>Ponente</strong> {{$actividad->user->nombre}}</li>
            <li> <strong>Evento</strong> {{ $actividad->evento->nombre }}</li>
            <li> <strong>Tipo</strong> {{ $actividad->tipo_actividad->nombre }}</li>
            <li> <strong>Fecha</strong> {{ $actividad->fecha }}</li>
            <li> <strong>Titulo</strong> {{ $actividad->titulo }}</li>
            <li> <strong>Inicio</strong> {{ $actividad->hora_inicio }}</li>
            <li> <strong>Fin </strong> {{ $actividad->hora_fin }}</li>
            <li> <strong>Resumen</strong> {{ $actividad->resumen }}</li>
          </ul>
        </li>
      </ul>

        @cannot('attend',$actividad)
          @can ('viewState',[$evento,['inscripciones','iniciado']])
            <a class="btn" href="/actividad/{{$actividad->id}}/asistir"> Asistir</a>
            <!--TODO VERIFICAR SI EL USUARIO ES COMITE JURADO O ENCARGADO DEL EVENTO y si el evento ya no esta en
                 Estado de Inscripciones -->
           @endcan
        @endcannot
        @can('modify',$actividad)
          @can ('viewState',[$evento,['inscripciones','iniciado']])
            <a class="btn" href="/actividad/{{$actividad->id}}/verificarAsistencia"> Verificar Asistencia!</a>
            <a class="btn" href="{{ route('actividad.presentador.create',$actividad->id) }}"> Asignar Presentador</a>
            <a class="btn" href="/actividad/{{$actividad->id}}/verAsistencia"> Ver Asistencia</a>
            <a class="btn" href="/actividad/{{$actividad->id}}/asistencia"> Descargar Asistencia</a>
          @endcan
        @endcan
        @can ('viewState',[$evento,['finalizado']])
        <a class="btn" href="{{ route('responderEncuestaActividad',$actividad->id) }}"> Calificar</a>
        @endcan
    </div>
  </div>

@endsection
