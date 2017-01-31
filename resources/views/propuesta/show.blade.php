@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Propuesta {{ $propuesta['id'] }}</h1>
    <ul>
      <li>Autor: {{ $propuesta['autor'] }}</li>
      <li>IdEvento: {{ $propuesta['idEvento'] }}</li>
      <li>Adjutnto: {{ $propuesta['adjunto'] }}</li>
      <li>Demanda: {{ $propuesta['demanda'] }}</li>
    </ul>
  </div>
@endsection
