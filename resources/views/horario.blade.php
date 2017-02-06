@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Tu Horario</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <th> Ponente</th>
        <th> Actividad</th>
        <th> Fecha</th>
        <th> Inicio </th>
        <th> Fin </th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($horario as $value)
        <tr>
          <td> {{$value->ponente}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->fecha}}</td>
          <td> {{$value->hora_inicio}}</td>
          <td> {{$value->hora_fin}}</td>
          <td>
            <a <a href="{{route('actividad.show',$value->id_actividad)}}"> Ver Actividad</a>
            {{ Form::open(['method' => 'DELETE','route' => ['asiste.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
