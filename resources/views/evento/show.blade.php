@extends('layouts.app')

@section('content')
  <div class="container">
              {{ Form::open(['method' => 'POST','route' => ['actividad.createFromProp',$evento->id],'style' => 'display:none']) }}
              {{ Form::submit('Aprobar')}}
              {{ Form::close()}}

    <ul class="collection with-header">
      <li class="collection-header"> <h4> {{$evento['nombre']}}</h4> </li>
      <li class="collection-item">
        <ul>
          <li> <strong>Creador</strong> {{$evento['user']->nombre}}</li>
          <li> <strong>Lugar</strong> {{ $evento['lugar'] }}</li>
          <li> <strong>Fecha de Inicio</strong> {{ $evento['fecha_inicio'] }}</li>
          <li> <strong>Fecha de Finalizacion</strong> {{ $evento['fecha_fin'] }}</li>
          <li> <strong>Cantidad de Actividades max.</strong> {{ $evento['cant_max'] }}</li>
          <li> <strong>Puntuacion minima </strong> {{ $evento['punt_min_aprobatorio'] }} puntos</li>
          <li> <strong>Estado</strong> {{ $evento['estado'] }}</li>
        </ul>
      </li>
      <li class="collection-item">
          <a class="btn" href="{{ route('evento.propuesta.index',$evento->id)}}"> Ver propuestas</a>
          <a class="btn" href="{{ route('evento.propuesta.create',$evento->id)}}"> Aplicar</a>
          <a class="btn" href="{{ route('evento.actividad.index',$evento->id)}}"> Ver actividades</a>
          <a class="btn" href="{{ route('evento.comite.index',$evento->id) }}"> Ver comite</a>
          <a class="btn" href="{{ route('evento.comite.create',$evento->id) }}"> Asignar Jurado</a>
      </li>
    </ul>
  </div>
@endsection
