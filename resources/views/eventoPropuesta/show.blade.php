@extends('layouts.app')

@section('content')
<div class="content-head col s12">
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
  <div class="container">
    <h3> Detalles Propuesta</h3>
  </div>
</div>

<div class="content-body">
  <div class="container">
    <ul class="collection with-header">
      <li class="collection-header"> <h4> {{$propuesta['titulo']}}</h4> </li>
      <li class="collection-item">
        <ul>
          <li> <strong>Autor</strong> {{$propuesta['user']->nombre}}</li>
          @can('aprove',$propuesta)
            @can ('viewState',[$evento,['inscripciones']])
                    <li> <strong>Demanda</strong> {{ $propuesta['demanda'] }}</li>
              @endcan
            @endcan
          <li> <strong>Descripcion</strong> {{ $propuesta['descripcion'] }}</li>
        </ul>
      </li>

          <li class="collection-item">
            @can('aprove',$propuesta)
              @can ('viewState',[$evento,['inscripciones']])
              <a class="btn" href="{{ route('actividad.createFromProp',$propuesta->id) }}"
              onclick="event.preventDefault();
                       document.getElementById('aprobar-form').submit();">
                Aprobar</a>
                {{ Form::open(['method' => 'POST','route' => ['actividad.createFromProp',$propuesta->id],'id'=>'aprobar-form','style' => 'display:none']) }}
                {{ Form::submit('Aprobar')}}
                {{ Form::close()}}
                @endcan
              @endcan
                <a class="btn" href="{{ $propuesta->adjunto}}" target="_blank">
                  Descargar Adjunto
                  </a>
          </li>

    </ul>
  </div>
</div>

@endsection
