@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Eventos</h1>

    <table>
      <thead>
        <tr>
          <th> Creador </th>
          <th> Nombre </th>
          <th> Lugar </th>
          <th> Inicio </th>
          <th> Fin </th>
          <th> Estado </th>
          <th> Acciones </th>
        </tr>
      </thead>

      <tbody>
        @foreach($evento as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->nombre}}</td>
          <td> {{$value->lugar}}</td>
          <td> {{$value->fecha_inicio}}</td>
          <td> {{$value->fecha_fin}}</td>
          <td> {{$value->estado}}</td>
          <td>
            <a href="{{route('evento.show',$value->id)}}"> Mostrar</a>
            <a href="{{route('evento.edit',$value->id)}}"> Editar</a>
            {{ Form::open(['method' => 'DELETE','route' => ['evento.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
