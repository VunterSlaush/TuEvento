@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Jurado</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$id_evento.'/comite'))}}

    <div class="row">
      <div class="col m6">
        {{Form::label('cedula','Usuario id')}}
        {{Form::text('cedula')}}
      </div>
      <div class="col m6">
        {{Form::label('id_evento','Evento id')}}
        {{Form::text('id_evento')}}
      </div>
      {{Form::submit('Crear')}}
      {{Form::close()}}
    </div>

  </div>
@endsection
