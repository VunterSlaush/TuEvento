@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> Estadisticas</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3> Estadisticas </h3>
    </div>
  </div>
  <div class="content-body">
    <div class="container">
      <div class="slider">
        <ul class="slides">
          <li>
            <center>
                {!! $asistencias->render() !!}
            </center>
          </li>
          <li>
            <center>
                {!! $puntuadas->render() !!}
            </center>
          </li>
          <li>
            <center>
                {!! $organizaciones->render() !!}
            </center>
          </li>

        </ul>
      </div>
    </div>
  </div>

@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.slider').slider({interval:10000});
  });
</script>
@endsection
