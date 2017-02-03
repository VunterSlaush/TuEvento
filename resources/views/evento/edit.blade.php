@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Eventos Index</h1>
    <ul>
      <li> <a href="{{ URL::to('actividad')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('actividad/create')}}"> Crear</a></li>
    </ul>

    <h1> Editar evento</h1>

    {{Html::ul($errors->all())}}

  {{Form::model($evento, array('route' => array('evento.update', $evento->id), 'method' => 'PUT'))}}

    <div class="">
      <div class="">
        {{Form::label('nombre','Nombre')}}
        {{Form::text('nombre')}}
      </div>
      <div class="">
        {{Form::label('lugar','Lugar')}}
        {{Form::text('lugar')}}
      </div>
      <div class="">
        {{Form::label('fecha_inicio','fecha_inicio')}}
        {{Form::date('fecha_inicio')}}
      </div>
      <div class="">
        {{Form::label('fecha_fin','fecha_fin')}}
        {{Form::date('fecha_fin')}}
      </div>
      <div class="">
        {{Form::label('cant_max_actividades','Cant. Actividades')}}
        {{Form::number('cant_max_actividades')}}
      </div>
      <div class="">
        {{Form::label('punt_min_aprobatorio','Puntuacion Minima')}}
        {{Form::number('punt_min_aprobatorio')}}
      </div>
      {{Form::submit('Editar')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
