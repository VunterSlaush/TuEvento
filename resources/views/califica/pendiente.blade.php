@extends('layouts.app')

@section('content')
<div class="container">
  <nav id="breadcrumb-nav">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="/califica" class="breadcrumb"> Calificar</a>
        <a href="#" class="breadcrumb"> Pendientes</a>
      </div>
    </div>
  </nav>
  <h3>Propuestas Pendientes por Calificar</h3>

  @if (Session::has('success'))
  <div class="">
    {{Session::get('success')}}
  </div>
  @endif

  <table id='event_table'>
    <thead>
      <td> id </td>
      <td> autor </td>
      <td> Evento</td>
      <td> titulo</td>
    </thead>
    <tbody>
      @foreach($propuestas as $key => $value)
      <tr>
        <td> {{$value->id}}</td>
        <td> {{$value->user->nombre}}</td>
        <td> {{$value->evento->nombre}}</td>
        <td> {{$value->titulo}}</td>
        <td>
          <a href="{{route('propuesta.show',$value->id)}}"> Ver detalles</a>
          <a href="{{route('seleccionarEncuesta',$value->id)}}"> Evaluar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
