@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>evento Index</h1>
    <ul>
      <li> <a href="{{ URL::to('evento')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('evento/create')}}"> Crear</a></li>
    </ul>

    <h1> Crear evento</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento'))}}

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
        {{Form::date('fecha_inicio','\Carbon\Carbon::now()')}}
      </div>
      <div class="">
        {{Form::label('fecha_fin','fecha_fin')}}
        {{Form::date('fecha_fin','\Carbon\Carbon::now()')}}
      </div>
      <div class="">
        {{Form::label('cant_max_actividades','Cant. Actividades')}}
        {{Form::text('cant_max_actividades')}}
      </div>
      <div class="">
        {{Form::label('punt_min_aprobatorio','Puntuacion Minima')}}
        {{Form::text('punt_min_aprobatorio','50')}}
      </div>
      {{Form::submit('Crear')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
