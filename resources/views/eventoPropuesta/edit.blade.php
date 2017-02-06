@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Editar Propuesta</h1>

    {{Html::ul($errors->all())}}

    {{Form::model($propuesta, array('route' => array('evento.propuesta.update',$id_evento,$propuesta->id), 'method' => 'PUT'))}}

    <div class="">
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
