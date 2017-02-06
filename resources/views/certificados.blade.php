@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Todos Los Certificados</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <th> Evento </th>
        <th> Ponente</th>
        <th> Actividad</th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($certificados as $value)
        <tr>
          <td> {{$value->evento}}</td>
          <td> {{$value->ponente}}</td>
          <td> {{$value->titulo}}</td>
          <td>
            <a href="/certificado/{{$value->codigo}}" target="_blank"> Imprimir</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
