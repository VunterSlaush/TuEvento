@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Eventos Index</h1>
    <ul>
      <li> <a href="{{ URL::to('evento')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('evento/create')}}"> Crear</a></li>
    </ul>

    <h1> Todas las propuestas</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <td> id - </td>
        <td> creador - </td>
        <td> nombre -</td>
        <td> lugar -</td>
        <td> fecha_inicio - </td>
        <td> fecha_fin - </td>
        <td> cant_max - </td>
        <td> punt_min_aprobatorio - </td>
        <td> estado - </td>
      </thead>
      <tbody>
        @foreach($evento as $key => $value)
        <tr>
          <td> {{$value->id}}</td>
          <td> {{$value->creador}}</td>
          <td> {{$value->nombre}}</td>
          <td> {{$value->lugar}}</td>
          <td> {{$value->fecha_inicio}}</td>
          <td> {{$value->fecha_fin}}</td>
          <td> {{$value->cant_max_actividaes}}</td>
          <td> {{$value->punt_min_aprobatorio}}</td>
          <td> {{$value->estado}}</td>
          <td>
            {{ Form::open(['method' => 'DELETE','route' => ['evento.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
            <a href="{{route('evento.show',$value->id)}}"> Mostrar</a>
            <a href="{{route('evento.edit',$value->id)}}"> Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
