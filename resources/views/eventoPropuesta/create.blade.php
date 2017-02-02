@extends('layouts.app')

@section('content')
  <div class="container">

    <h1> Crear propuesta</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$id_evento.'/propuesta'))}}

    <div class="">
      <div class="">
        {{Form::label('titulo','Titulo')}}
        {{Form::text('titulo')}}
      </div>
      <div class="">
        {{Form::label('duracion','Duracion')}}
        {{Form::text('duracion')}}
      </div>
      <div class="">
        {{Form::label('descripcion','Descripcion')}}
        {{Form::text('descripcion')}}
      </div>
      <div class="">
        {{Form::label('adjunto','Adjunto')}}
        {{Form::File('adjunto')}}
      </div>
      <div class="">
        {{Form::label('demanda','Demanda')}}
        {{Form::text('demanda')}}
      </div>
      {{Form::submit('Crear')}}

      {{Form::close()}}
    </div>

  </div>
@endsection
