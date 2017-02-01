@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Evento {{ $evento['id'] }}</h1>
    <ul>
      <li>Creador: {{ $evento['creador'] }}</li>
      <li>Nombre: {{ $evento['nombre'] }}</li>
      <li>Lugar: {{ $evento['lugar'] }}</li>
      <li>Fecha Inicio: {{ $evento['fecha_inicio'] }}</li>
      <li>Fecha Fin: {{ $evento['fecha_fin'] }}</li>
      <li>Cant Max: {{ $evento['cant_max'] }}</li>
      <li>Punt Min: {{ $evento['punt_min_aprobatorio'] }}</li>
      <li>Estado: {{ $evento['estado'] }}</li>
      @foreach($evento->propuestas()->get() as $key => $value)
        <li> Propuestas:
          <ul>
            <li>Id: {{$value->id}}</li>
            <li>Id: {{$value->autor}}</li>
            <li>Evento: {{$value->idEvento}}</li>
            <li>Titulo: {{$value->titulo}}</li>
            <li>Adjunto: {{$value->adjunto}}</li>
            <li>Demanda: {{$value->demanda}}</li>
            <li>Descripcion: {{$value->descripcion}}</li>
            <li>Duracion: {{$value->duracion}}</li>
            <li>
              {{ Form::open(['method' => 'POST','route' => ['actividad.createFromProp',$value->id]]) }}
              {{ Form::submit('Aprobar')}}
              {{ Form::close()}}
            </li>
          </ul>
        </li>
      @endforeach
    </ul>
  </div>
@endsection