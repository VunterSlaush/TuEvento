@extends('layouts.app')

@section('content')

<div class="content-head col s12">
  <nav id="breadcrumb-nav" class="hide-on-med-and-down">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="/califica" class="breadcrumb"> Calificar</a>
        <a href="#" class="breadcrumb"> Calificadas</a>
      </div>
    </div>
  </nav>
  <div class="container">
    <h3>  Propuestas calificadas por Usted</h3>
  </div>
</div>

<div class="content-body">
  <div class="container">
    @if (Session::has('success'))
    <div class="">
      {{Session::get('success')}}
    </div>
    @endif

    <table>
      <thead>
        <td> titulo </td>
        <td> autor </td>
        <td> evento</td>

      </thead>
      <tbody>
        @foreach($propuestas as $key => $value)
        <tr>
          <td> {{$value->titulo}}</td>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->evento->nombre}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
