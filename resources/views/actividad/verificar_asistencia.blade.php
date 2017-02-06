@extends('layouts.app')

@section('content')
<div class="container">
  <h1> Verificar Asistencia </h1>
  {!! Form::open(array('route' => 'marcarAsistencia', 'class' => 'form')) !!}
  <div class="form-group">
      {!! Form::label('Ingrese Cedula:') !!}
      {!! Form::text('cedula', null,
          array('required',
                'class'=>'form-control',
                'placeholder'=>'Cedula')) !!}
  </div>
  {{ Form::hidden('id_actividad', $id_actividad) }}
  <div class="form-group">
    {!! Form::submit('Enviar',
      array('class'=>'btn btn-primary')) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection
