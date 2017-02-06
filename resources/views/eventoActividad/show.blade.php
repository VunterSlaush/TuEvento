@extends('layouts.app')

@section('content')
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
      </ul>
    </li>
  </ul>
  <a href="/actividad/{{$actividad->id}}/asistir"> Asistir</a>
  <!--TODO VERIFICAR SI EL USUARIO ES COMITE JURADO O ENCARGADO DEL EVENTO y si el evento ya no esta en
       Estado de Inscripciones -->
  <a href="/actividad/{{$actividad->id}}/verificarAsistencia"> Verificar Asistencia!</a>
</div>
@endsection
