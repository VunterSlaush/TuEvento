@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Comite Index</h1>
    <ul>
      <li> <a href="{{ URL::to('comite')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('comite/create')}}"> Crear</a></li>
    </ul>

    <h1> Todos</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <td> usuario </td>
        <td> -es jurado en- </td>
        <td> evento</td>
      </thead>
      <tbody>
        @foreach($comite as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> -></td>
          <td> {{$value->evento->nombre}}</td>
          <td>
            {{ Form::open(['method' => 'DELETE','route' => ['comite.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
            <a href="{{route('comite.show',$value->id)}}"> Mostrar</a>
            <a href="{{route('comite.edit',$value->id)}}"> Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
