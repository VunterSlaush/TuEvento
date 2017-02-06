@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Actividades Index</h1>
    <ul>
      <li> <a href="{{ URL::to('actividad')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('actividad/create')}}"> Crear</a></li>
    </ul>

    <h1> Crear actividad</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'actividad'))}}

    <div class="">
      <div class="">
        {{Form::label('id','Id')}}
        {{Form::text('id')}}
      </div>
      <div class="">
        {{Form::label('ponente','Ponente')}}
        {{Form::text('ponente')}}
      </div>
      <div class="">
        {{Form::label('evento','Evento')}}
        {{Form::text('evento')}}
      </div>
      <div class="">
        {{Form::label('fecha','Fecha')}}
        {{Form::Date('fecha',\Carbon\Carbon::now())}}
      </div>
      <div class="">
        {{Form::label('titulo','Titulo')}}
        {{Form::text('titulo')}}
      </div>
      <div class="">
        {{Form::label('hora_inicio','Hora de Inicio')}}
        {{Form::Date('hora_inicio',\Carbon\Carbon::now())}}
      </div>
      <div class="">
        {{Form::label('hora_fin','Hora de Finaliz.')}}
        {{Form::Date('hora_fin',\Carbon\Carbon::now())}}
      </div>
      <div class="">
        {{Form::label('resumen','Resumen')}}
        {{Form::text('resumen')}}
      </div>
      {{Form::submit('Crear')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
