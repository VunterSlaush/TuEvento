@extends('layouts.app')

@section('content')
<div class="container">


  <h1> Propuestas calificadas por Usted</h1>

  @if (Session::has('success'))
  <div class="">
    {{Session::get('success')}}
  </div>
  @endif

  <table>
    <thead>
      <td> titulo </td>
      <td> autor </td>
      <td> evento</td>

    </thead>
    <tbody>
      @foreach($propuestas as $key => $value)
      <tr>
        <td> {{$value->titulo}}</td>
        <td> {{$value->autor}}</td>
        <td> {{$value->evento->nombre}}</td>

        <td>
          {{ Form::open(['method' => 'DELETE','route' => ['califica.destroy', $value->id],'style'=>'display:inline'])}}
          {{ Form::submit('Eliminar')}}
          {{ Form::close()}}
          <a href="{{route('califica.show',$value->id)}}"> Ver detalles</a>
          <a href="{{route('califica.edit',$value->id)}}"> Editar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


</div>
@endsection
