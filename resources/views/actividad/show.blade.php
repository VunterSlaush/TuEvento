@extends('layouts.app')

@section('content')
<div class="content-head col s12">
  <nav id="breadcrumb-nav" class="hide-on-med-and-down">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="/misActiviades" class="breadcrumb"> Mis Actividades</a>
        <a href="#" class="breadcrumb"> {{$actividad->titulo}}</a>
      </div>
    </div>
  </nav>
  <div class="container">
    <h3> {{$actividad->titulo}} </h3>
  </div>
</div>

<div class="content-body">
  <div class="container">
    <ul class="collection with-header">
      <li class="collection-header"> <h4> {{$actividad['titulo']}}</h4> </li>
      <li class="collection-item">
        <ul>
          <li> <strong>Ponente</strong> {{$actividad['user']->nombre}}</li>
          <li> <strong>Evento</strong> {{ $actividad['evento']->nombre }}</li>
          <li> <strong>Fecha</strong> {{ $actividad['fecha'] }}</li>
          <li> <strong>Titulo</strong> {{ $actividad['titulo'] }}</li>
          <li> <strong>Inicio</strong> {{ $actividad['hora_inicio'] }}</li>
          <li> <strong>Fin </strong> {{ $actividad['hora_fin'] }}</li>
          <li> <strong>Resumen</strong> {{ $actividad['resumen'] }}</li>
          @foreach ($actividad->presentadores as $key => $presentador)
            <li> <strong>Presentador</strong> {{ $presentador->user->nombre}}</li>
          @endforeach
        </ul>
      </li>
    </ul>
    @cannot('attend',$actividad)
      <a class="btn" href="/actividad/{{$actividad->id}}/asistir"> Asistir</a>

        <!--TODO VERIFICAR SI EL USUARIO ES COMITE JURADO O ENCARGADO DEL EVENTO y si el evento ya no esta en
            Estado de Inscripciones -->
    @endcannot
    @can('modify',$actividad)
      <a class="btn" href="/actividad/{{$actividad->id}}/verificarAsistencia"> Verificar Asistencia!</a>
      <a class="btn" href="{{ route('actividad.presentador.create',$actividad->id) }}"> Asignar Presentador</a>
      <a class="btn" href="{{ route('responderEncuestaActividad',$actividad->id) }}"> Calificar</a>
      <a class="btn" href="/actividad/{{$actividad->id}}/verAsistencia"> Ver Asistencia</a>
      <a class="btn" href="/actividad/{{$actividad->id}}/asistencia"> Descargar Asistencia</a>
    @endcan
  </div>
</div>
@endsection
