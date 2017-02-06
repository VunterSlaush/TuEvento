@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Todos</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <th> Evento </th>
        <th> Usuario</th>
        <th> Acciones</th>
      </thead>
      <tbody>
        @foreach($comite as $key => $value)
        <tr>
          <td> {{$value->evento->nombre}}</td>
          <td> {{$value->user->nombre}}</td>
          <td>
            <a href="{{route('evento.comite.show',[$id_evento,$value->id])}}"> Mostrar</a>
            <a href="{{route('evento.comite.edit',[$id_evento,$value->id])}}"> Editar</a>
              {{ Form::open(['method' => 'DELETE','route' => ['comite.destroy', $value->id],'style'=>'display:inline'])}}
              {{ Form::submit('Eliminar')}}
              {{ Form::close()}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
