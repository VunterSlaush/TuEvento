@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="#" class="breadcrumb"> Certificados</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3> Certificados</h3>
    </div>
  </div>

  <div class="content-body">
    <div class="container">
      <h4>Por Actividad</h4>
      <table id="event_table">
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
              <a href="/certificado/{{$value->codigo}}" target="_blank"><i class="material-icons">print</i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <h1>&nbsp;</h1>
      <h4>Por Evento</h4>
      <table id="comite_table">
        <thead>
          <th> Evento </th>
          <th> Acciones </th>
        </thead>
        <tbody>
          @foreach($certificados_evento as $value)
          <tr>
            <td> {{$value->evento}}</td>
            <td>
              <a href="{{route('certificadoEvento',['evento' => $value->id_evento,'cedula'=>$value->cedula])}}" target="_blank"><i class="material-icons">print</i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
