@extends('layouts.app')

@section('content')
<div class="content-head col s12">
  <nav id="breadcrumb-nav" class="hide-on-med-and-down">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="#" class="breadcrumb"> Calificar</a>
      </div>
    </div>
  </nav>
  <div class="container">
    <h3>  Calificar Propuestas</h3>
  </div>
  </div>

  <div class="content-body">
    <div class="container">
      @if (Session::has('success'))
      <div class="">
        {{Session::get('success')}}
      </div>
      @endif
      <div class="col m12 row">
        <div class="col m6">
          <center><i class="small material-icons" style="color:#1565c0;">info_outline</i>
          <h4>Pendientes</h4>
          <a class="waves-effect waves-light btn" href="{{ URL::to('califica/pendiente')}}">Ver</a></div></center>
        <div class="col m6">
          <center><i class="small material-icons" style="color:#1565c0;">done_all</i>
          <h4>Calificadas</h4>
          <a class="waves-effect waves-light btn" href="{{ URL::to('califica/lista')}}">Ver</a></div></center>
      </div>
    </div>
  </div>
@endsection
