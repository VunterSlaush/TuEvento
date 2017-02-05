@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Todas las actividades</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <th> Ponente </th>
        <th> Evento</th>
        <th> Fecha</th>
        <th> Titulo </th>
        <th> Inicio </th>
        <th> Fin </th>
        <th> Resumen </th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($actividad as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->evento->nombre}}</td>
          <td> {{$value->fecha}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->hora_inicio}}</td>
          <td> {{$value->hora_fin}}</td>
          <td> {{$value->resumen}}</td>
          <td>
            <a href="{{route('actividad.show',$value->id)}}"> Mostrar</a>
            <a href="{{route('actividad.edit',$value->id)}}"> Editar</a>
            {{ Form::open(['method' => 'DELETE','route' => ['actividad.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
