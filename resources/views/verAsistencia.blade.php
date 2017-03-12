@extends('layouts.app')

@section('content')
  <div class="container">
  
    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif
    <h4>&nbsp;</h4>
    <h3>Asistencia de la Actividad</h3>
    <table id="event_table">
      <thead>
        <th>Nombre</th>
        <th>Cedula</th>
        <th>Email</th>
        <th>Asistencia</th>
      </thead>
      <tbody>
        @foreach($asistencia as $value)
        <tr>
          <td>{{$value->nombre}}</td>
          <td>{{$value->cedula}}</td>
          <td>{{$value->email}}</td>          
          @if (($value->asistio) === true) 
            <td>Asistio</td>
          @else <td>No asistio</td>
          @endif          
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
