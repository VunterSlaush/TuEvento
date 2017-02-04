@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Comite Index</h1>
    <ul>
      <li> <a href="{{ URL::to('comite')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('comite/create')}}"> Crear</a></li>
    </ul>

    <h1> Todos</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'comite'))}}

    <div class="">
      <div class="">
        {{Form::label('cedula','Usuario id')}}
        {{Form::text('cedula')}}
      </div>
      <div class="">
        {{Form::label('id_evento','Evento id')}}
        {{Form::text('id_evento')}}
      </div>
      {{Form::submit('Crear')}}
      {{Form::close()}}
    </div>

  </div>
@endsection
