@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Propuestas Pendientes por Calificar</h1>

  @if (Session::has('success'))
  <div class="">
    {{Session::get('success')}}
  </div>
  @endif

  <table>
    <thead>
      <td> id </td>
      <td> autor </td>
      <td> idEvento</td>
      <td> titulo</td>
      <td> adjunto</td>
      <td> demanda </td>
      <td> descripcion </td>
    </thead>
    <tbody>
      @foreach($propuestasvec as $key => $value)
      <tr>
        <td> {{$value->id}}</td>
        <td> {{$value->autor}}</td>
        <td> {{$value->idEvento}}</td>
        <td> {{$value->titulo}}</td>
        <td> {{$value->adjunto}}</td>
        <td> {{$value->demanda}}</td>
        <td> {{$value->descripcion}}</td>
        <td>
          <a href="{{route('propuesta.show',$value->id)}}"> Ver detalles</a>

          <a href="{{route('califica.create',$value->id)}}"> Calificar!</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
