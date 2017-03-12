@extends('layouts.app')

@section('content')
  <div class="container">
    <nav id="breadcrumb-nav">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> Propuestas</a>
        </div>
      </div>
    </nav>
    <h1> Todas las propuestas</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table id="event_table">
      <thead>
        <th> Autor </th>
        <th> Adjunto </th>
        <th> Demanda </th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($propuesta as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->adjunto}}</td>
          <td> {{$value->demanda}}</td>
          <td>
            <a href="{{route('evento.propuesta.show',[$evento->id,$value->id])}}"> Mostrar</a>
            @can('modify',$value)
              <a href="{{route('evento.propuesta.edit',[$evento->id,$value->id])}}"> Editar</a>
              {{ Form::open(['method' => 'DELETE','route' => ['propuesta.destroy', $value->id],'style'=>'display:inline'])}}
              {{ Form::submit('Eliminar')}}
              {{ Form::close()}}
            @endcan
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
