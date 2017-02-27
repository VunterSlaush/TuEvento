@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Todos Los Certificados</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif
    <h4>&nbsp;</h4>
    <h3>Certificados Por Actividad</h3>
    <table>
      <thead>
        <th>Evento</th>
        <th>Ponente</th>
        <th>Actividad</th>
        <th>Acciones</th>
      </thead>
      <tbody>
        @foreach($certificados_actividad as $value)
        <tr>
          <td>{{$value->evento}}</td>
          <td>{{$value->ponente}}</td>
          <td>{{$value->titulo}}</td>
          <td>
            <a href="/certificado/{{$value->codigo}}" target="_blank"> Imprimir</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <h1>&nbsp;</h1>
    <h3>Certificados Por Evento</h3>
    <table>
      <thead>
        <th> Evento </th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($certificados_evento as $value)
        <tr>
          <td> {{$value->evento}}</td>
          <td>
            <a href="{{route('certificadoEvento',['evento' => $value->id_evento,'cedula'=>$value->cedula])}}" target="_blank"> Imprimir</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
