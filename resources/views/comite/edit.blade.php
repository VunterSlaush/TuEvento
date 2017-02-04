@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>comite Index</h1>
    <ul>
      <li> <a href="{{ URL::to('comite')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('comite/create')}}"> Crear</a></li>
    </ul>

    <h1> Crear</h1>

    {{Html::ul($errors->all())}}

  {{Form::model($comite, array('route' => array('comite.update', $comite->id), 'method' => 'PUT'))}}

    <div class="">
      <div class="">
        {{Form::label('id_evento','id_evento')}}
        {{Form::text('id_evento')}}
      </div>
      <div class="">
        {{Form::label('cedula','usuario')}}
        {{Form::text('cedula')}}
      </div>

      {{Form::submit('Editar')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
