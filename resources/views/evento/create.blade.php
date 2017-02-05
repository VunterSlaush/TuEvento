@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Crear evento</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento'))}}
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
        {{Form::date('fecha_inicio','\Carbon\Carbon::now()')}}
      </div>
      <div class="col m6">
        {{Form::label('fecha_fin','fecha_fin')}}
        {{Form::date('fecha_fin','\Carbon\Carbon::now()')}}
      </div>
      <div class="col m6">
        {{Form::label('cant_max_actividades','Cant. Actividades')}}
        {{Form::text('cant_max_actividades')}}
      </div>
      <div class="col m6">
        {{Form::label('punt_min_aprobatorio','Puntuacion Minima')}}
        {{Form::text('punt_min_aprobatorio','50')}}
      </div>
      {{Form::submit('Crear')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
