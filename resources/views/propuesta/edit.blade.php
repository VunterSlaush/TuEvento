@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Propuestas Index</h1>
    <ul>
      <li> <a href="{{ URL::to('propuesta')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('propuesta/create')}}"> Crear</a></li>
    </ul>

    <h1> Crear propuesta</h1>

    {{Html::ul($errors->all())}}

    {{Form::model($propuesta, array('route' => array('propuesta.update', $propuesta->id), 'method' => 'PUT'))}}

    <div class="">
      <div class="">
        {{Form::label('id_evento','id_evento')}}
        {{Form::text('id_evento')}}
      </div>
      <div class="">
        {{Form::label('adjunto','Adjunto')}}
        {{Form::File('adjunto')}}
      </div>
      <div class="">
        {{Form::label('demanda','Demanda')}}
        {{Form::text('demanda')}}
      </div>
      {{Form::submit('Editar')}}

      {{Form::close()}}
    </div>
  </div>
  @endsection
