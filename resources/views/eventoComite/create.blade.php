@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Comite:</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$id_evento.'/comite'))}}

    <div class="row">
      <div class="col m6">
        {{Form::label('Ingrese la Cedula','Usuario id')}}
        {{Form::text('id_user')}}
      </div>
      {{Form::submit('Crear')}}
      {{Form::close()}}
    </div>

  </div>
@endsection
