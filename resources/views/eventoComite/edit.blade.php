@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Editar </h1>

    {{Html::ul($errors->all())}}

  {{Form::model($comite, array('route' => array('evento.comite.update',$id_evento, $comite->id), 'method' => 'PUT'))}}

    <div class="row">
      <div class="col m6">
        {{Form::label('id_evento','id_evento')}}
        {{Form::text('id_evento')}}
      </div>
      <div class="col m6">
        {{Form::label('cedula','usuario')}}
        {{Form::text('cedula')}}
      </div>
      {{Form::submit('Editar')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
