@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Propuesta {{ $actividad['id'] }}</h1>
    <ul>
      <li>Autor: {{ $actividad['autor'] }}</li>
      <li>id_evento: {{ $actividad['id_evento'] }}</li>
      <li>Adjutnto: {{ $actividad['adjunto'] }}</li>
      <li>Demanda: {{ $actividad['demanda'] }}</li>
    </ul>
  </div>
@endsection
