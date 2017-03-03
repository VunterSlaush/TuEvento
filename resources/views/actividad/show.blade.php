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
    @endcan
  </div>
@endsection
