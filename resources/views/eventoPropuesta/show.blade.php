@extends('layouts.app')

@section('content')
<div class="container">
  <nav id="breadcrumb-nav" class="hide-on-med-and-down">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
        <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
        <a href="#" class="breadcrumb"> {{$propuesta->titulo}} </a>
      </div>
    </div>
  </nav>

  <ul class="collection with-header">
    <li class="collection-header"> <h4> {{$propuesta['titulo']}}</h4> </li>
    <li class="collection-item">
      <ul>
        <li> <strong>Autor</strong> {{$propuesta['user']->nombre}}</li>
        <li> <strong>Adjunto</strong> {{ $propuesta['adjunto'] }}</li>
        <li> <strong>Demanda</strong> {{ $propuesta['demanda'] }}</li>
      </ul>
    </li>
    @can('aprove',$propuesta)
      @can ('viewState',[$evento,['inscripciones']])
        <li class="collection-item">
            <a class="btn" href="{{ route('actividad.createFromProp',$propuesta->id) }}"
            onclick="event.preventDefault();
                     document.getElementById('aprobar-form').submit();">
              Aprobar</a>
              {{ Form::open(['method' => 'POST','route' => ['actividad.createFromProp',$propuesta->id],'id'=>'aprobar-form','style' => 'display:none']) }}
              {{ Form::submit('Aprobar')}}
              {{ Form::close()}}
        </li>
      @endcan
    @endcan
  </ul>
</div>
@endsection
