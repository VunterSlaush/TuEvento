@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Actividad: {{$actividad->nombre}}</h1>
    <h3>  Asignar Presentador: </h3>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'actividad/'.$actividad->id.'/presentador'))}}

    <div class="row">
      <div class="col m6">
        {{Form::label('Ingrese la Cedula','Usuario id')}}
        {{Form::text('id_user')}}
      </div>
      {{Form::submit('Asignar')}}
      {{Form::close()}}
    </div>

  </div>
@endsection
