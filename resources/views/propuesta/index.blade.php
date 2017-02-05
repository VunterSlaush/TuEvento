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
        <th> Autor -</th>
        <th> Evento -</th>
        <th> Adjunto -</th>
        <th> Demanda -</th>
      </thead>
      <tbody>
        @foreach($propuesta as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->evento->nombre}}</td>
          <td> {{$value->adjunto}}</td>
          <td> {{$value->demanda}}</td>
          <td>
            <a href="{{route('propuesta.show',$value->id)}}"> Mostrar</a>
            <a href="{{route('propuesta.edit',$value->id)}}"> Editar</a>
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
