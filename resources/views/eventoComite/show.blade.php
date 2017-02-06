@extends('layouts.app')

@section('content')
  <div class="container">
    <ul class="collection with-header">
      <li class="collection-header"> <h4> Comite {{$comite[0]->evento->nombre}}</h4> </li>
      <li class="collection-item">
        <ul>
          <li> <strong>Evento</strong> {{$comite[0]->evento->nombre}}</li>
          <li> <strong>Jurado</strong> {{ $comite[0]->user->nombre }}</li>
        </ul>
      </li>
    </ul>
  </div>
@endsection
