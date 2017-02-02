@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Evento {{$id_evento}} Index</h1>

    <h1> Todas las propuestas</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <td> id -</td>
        <td> autor -</td>
        <td> id_evento -</td>
        <td> adjunto -</td>
        <td> demanda -</td>
      </thead>
      <tbody>
        @foreach($propuesta as $key => $value)
        <tr>
          <td> {{$value->id}}</td>
          <td> {{$value->autor}}</td>
          <td> {{$value->id_evento}}</td>
          <td> {{$value->adjunto}}</td>
          <td> {{$value->demanda}}</td>
          <td>
            {{ Form::open(['method' => 'DELETE','route' => ['propuesta.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
            <a href="{{route('evento.propuesta.show',[$id_evento,$value->id])}}"> Mostrar</a>
            <a href="{{route('evento.propuesta.edit',[$id_evento,$value->id])}}"> Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
