@extends('layouts.app')

@section('content')
  <div class="container">
    <nav id="breadcrumb-nav">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="#" class="breadcrumb"> Mis Propuestas</a>
        </div>
      </div>
    </nav>
    <h1> Todas las propuestas</h1>


  @if (Session::has('success'))
  <div class="">
    {{Session::get('success')}}
  </div>
  @endif

    <table id="event_table">
      <thead>
        <th>Autor</th>
        <th>Evento</th>
        <th>Adjunto</th>
        <th>Demanda</th>
        <th>Acciones</th>
      </thead>
      <tbody>
        @foreach($propuesta as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->evento->nombre}}</td>
          <td> {{$value->adjunto}}</td>
          <td> {{$value->demanda}}</td>
          <td>
            <a href="{{route('evento.propuesta.show',[$value->evento->id,$value->id])}}"> Mostrar</a>
            <a href="{{route('evento.propuesta.edit',[$value->evento->id,$value->id])}}"> Editar</a>
            {{ Form::open(['method' => 'DELETE','route' => ['propuesta.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
