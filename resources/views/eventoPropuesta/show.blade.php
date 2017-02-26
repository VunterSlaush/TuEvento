@extends('layouts.app')

@section('content')
<div class="container">
  <ul class="collection with-header">
    <li class="collection-header"> <h4> {{$propuesta['titulo']}}</h4> </li>
    <li class="collection-item">
      <ul>
        <li> <strong>Autor</strong> {{$propuesta['user']->nombre}}</li>
        <li> <strong>Adjunto</strong> {{ $propuesta['adjunto'] }}</li>
        <li> <strong>Demanda</strong> {{ $propuesta['demanda'] }}</li>
      </ul>
    </li>
    <li class="collection-item">
      @can('aprove',$propuesta)
        <a class="btn" href="{{ route('actividad.createFromProp',$propuesta->id) }}"
        onclick="event.preventDefault();
                 document.getElementById('aprobar-form').submit();">
          Aprobar</a>
          {{ Form::open(['method' => 'POST','route' => ['actividad.createFromProp',$propuesta->id],'id'=>'aprobar-form','style' => 'display:none']) }}
          {{ Form::submit('Aprobar')}}
          {{ Form::close()}}
      @endcan
    </li>
  </ul>
</div>
@endsection
