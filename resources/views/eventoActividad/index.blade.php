@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Actividades de: {{$nombre_evento}}</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <th> Creador </th>
        <th> Fecha </th>
        <th> Titulo </th>
        <th> Inicio </th>
        <th> Fin </th>
      </thead>
      <tbody>
        @foreach($actividad as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->fecha}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->hora_inicio}}</td>
          <td> {{$value->hora_fin}}</td>
          <td>
            <a href="{{route('evento.actividad.show',[$id_evento,$value->id])}}"> Mostrar</a>
            @can('modify',$value)
              <a href="{{route('evento.actividad.edit',[$id_evento,$value->id])}}"> Editar</a>
              {{ Form::open(['method' => 'DELETE','route' => ['actividad.destroy', $value->id],'style'=>'display:inline'])}}
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
