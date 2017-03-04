@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Calificar Propuestas</h1>
  <h1>&nbsp;</h1>
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
  @if (Session::has('success'))
  <div class="">
    {{Session::get('success')}}
  </div>
  @endif

</div>
@endsection
