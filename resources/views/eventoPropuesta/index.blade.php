@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Todas las propuestas</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
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
            <a href="{{route('evento.propuesta.show',[$id_evento,$value->id])}}"> Mostrar</a>
            <a href="{{route('evento.propuesta.edit',[$id_evento,$value->id])}}"> Editar</a>
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
