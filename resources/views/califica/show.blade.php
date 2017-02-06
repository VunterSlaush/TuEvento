@extends('layouts.app')

@section('content')
<div>
  <h1>Propuesta calificada{{ $califica['idPropuesta'] }}</h1>
  <ul>
    <li>Autor: {{ $califica['cedula'] }}</li>
    <li>calificacion: {{ $califica['calificacion'] }}</li>
    <li>IdEvento: {{ $propuesta['idEvento'] }}</li>
    <li>Adjutnto: {{ $propuesta['adjunto'] }}</li>
    <li>Demanda: {{ $propuesta['demanda'] }}</li>
  </ul>

  </ul>
</div>
@endsection
