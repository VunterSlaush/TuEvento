@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Crear actividad</h1>

    {{Html::ul($errors->all())}}

  {{Form::model($actividad, array('route' => array('actividad.update', $actividad->id), 'method' => 'PUT'))}}

      <div class="row">
        <div class="col m12">
          {{Form::label('titulo','Titulo')}}
          {{Form::text('titulo')}}
        </div>
      </div>
      <div class="row">
        <div class="col m6">
          {{Form::label('demanda','Demanda')}}
          {{Form::text('demanda')}}
        </div>
        <div class="col m6">
          {{Form::label('adjunto','Adjunto')}}
          {{Form::File('adjunto')}}
        </div>
      </div>

      {{Form::submit('Editar')}}

      {{Form::close()}}

  </div>
@endsection
