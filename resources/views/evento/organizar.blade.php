@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Organizador</h1>

  {{Html::ul($errors->all())}}
  {{Form::model($evento, array('route' => array('evento.update', $evento->id), 'method' => 'PUT'))}}

    <div class="row">
      <div class="col m6">
        {{Form::label('hora_inicio','Inicio')}}
        {{Form::time('hora_inicio')}}
      </div>
      <div class="col m6">
        {{Form::label('hora_fin','Fin')}}
        {{Form::date('hora_fin')}}
      </div>
      <div class="col m6">
        {{Form::label('fecha','Fecha')}}
        {{Form::date('fecha')}}
      </div>
      <div class="col m6">
        {{Form::button('listo')}}
      </div>
      {{Form::submit('Organizar')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
