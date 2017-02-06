@extends('layouts.app')

@section('content')
<div class="container">
  <ul class="collection with-header">
    <li class="collection-header"> <h4> {{$actividad[0]->titulo}}</h4> </li>
    <li class="collection-item">
      <ul>
        <li> <strong>Ponente</strong> {{$actividad[0]->user->nombre}}</li>
        <li> <strong>Evento</strong> {{ $actividad[0]->evento->nombre }}</li>
        <li> <strong>Fecha</strong> {{ $actividad[0]->fecha }}</li>
        <li> <strong>Titulo</strong> {{ $actividad[0]->titulo }}</li>
        <li> <strong>Inicio</strong> {{ $actividad[0]->hora_inicio }}</li>
        <li> <strong>Fin </strong> {{ $actividad[0]->hora_fin }}</li>
        <li> <strong>Resumen</strong> {{ $actividad[0]->resumen }}</li>
      </ul>
    </li>
  </ul>
  <a href="/actividad/{{$actividad[0]->id}}/asistir"> Asistir</a>
  <!--TODO VERIFICAR SI EL USUARIO ES COMITE JURADO O ENCARGADO DEL EVENTO y si el evento ya no esta en
       Estado de Inscripciones -->
  <a href="/actividad/{{$actividad[0]->id}}/verificarAsistencia"> Verificar Asistencia!</a>
</div>
@endsection
