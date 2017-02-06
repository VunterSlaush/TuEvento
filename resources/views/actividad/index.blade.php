@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Actividades Index</h1>
    <ul>
      <li> <a href="{{ URL::to('actividad')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('actividad/create')}}"> Crear</a></li>    
    </ul>

    <h1> Todas las actividades</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <td> id </td>
        <td> ponente </td>
        <td> evento</td>
        <td> fecha</td>
        <td> titulo </td>
        <td> Inicio </td>
        <td> Fin </td>
        <td> Resumen </td>
      </thead>
      <tbody>
        @foreach($actividad as $key => $value)
        <tr>
          <td> {{$value->id}}</td>
          <td> {{$value->ponente}}</td>
          <td> {{$value->evento}}</td>
          <td> {{$value->fecha}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->hora_inicio}}</td>
          <td> {{$value->hora_fin}}</td>
          <td> {{$value->resumen}}</td>
          <td>
            {{ Form::open(['method' => 'DELETE','route' => ['actividad.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
            <a href="{{route('actividad.show',$value->id)}}"> Mostrar</a>
            <a href="{{route('actividad.edit',$value->id)}}"> Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
