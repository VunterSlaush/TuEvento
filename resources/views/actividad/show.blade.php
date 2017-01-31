@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Propuesta {{ $actividad['id'] }}</h1>
    <ul>
      <li>Autor: {{ $actividad['autor'] }}</li>
      <li>IdEvento: {{ $actividad['idEvento'] }}</li>
      <li>Adjutnto: {{ $actividad['adjunto'] }}</li>
      <li>Demanda: {{ $actividad['demanda'] }}</li>
    </ul>
  </div>
@endsection
