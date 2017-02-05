@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Editar evento</h1>

  {{Html::ul($errors->all())}}
  {{Form::model($evento, array('route' => array('evento.update', $evento->id), 'method' => 'PUT'))}}

    <div class="row">
      <div class="col m6">
        {{Form::label('nombre','Nombre')}}
        {{Form::text('nombre')}}
      </div>
      <div class="col m6">
        {{Form::label('lugar','Lugar')}}
        {{Form::text('lugar')}}
      </div>
      <div class="col m6">
        {{Form::label('fecha_inicio','fecha_inicio')}}
        {{Form::date('fecha_inicio')}}
      </div>
      <div class="col m6">
        {{Form::label('fecha_fin','fecha_fin')}}
        {{Form::date('fecha_fin')}}
      </div>
      <div class="col m6">
        {{Form::label('cant_max_actividades','Cant. Actividades')}}
        {{Form::number('cant_max_actividades')}}
      </div>
      <div class="col m6">
        {{Form::label('punt_min_aprobatorio','Puntuacion Minima')}}
        {{Form::number('punt_min_aprobatorio')}}
      </div>
      {{Form::submit('Editar')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
