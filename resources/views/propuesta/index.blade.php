@extends('layouts.app')

@section('content')
    <div class="content-head col s12">
      <nav id="breadcrumb-nav" class="hide-on-med-and-down">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="/home" class="breadcrumb"> Dashboard</a>
            <a href="#" class="breadcrumb"> Mis Propuestas</a>
          </div>
        </div>
      </nav>
      <div class="container">
        <h3> Propuestas </h3>
      </div>
    </div>

    <div class="content-body">
      <div class="container">
        <table id="event_table">
          <thead>
            <th>Autor</th>
            <th>Evento</th>
            <th>Adjunto</th>
            <th>Demanda</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            @foreach($propuesta as $key => $value)
            <tr>
              <td> {{$value->user->nombre}}</td>
              <td> {{$value->evento->nombre}}</td>
              <td> {{$value->adjunto}}</td>
              <td> {{$value->demanda}}</td>
              <td>
                <a href="{{route('evento.propuesta.show',[$value->evento->id,$value->id])}}"> Mostrar</a>
                <a href="{{route('evento.propuesta.edit',[$value->evento->id,$value->id])}}"> Editar</a>
                {{ Form::open(['method' => 'DELETE','route' => ['propuesta.destroy', $value->id],'style'=>'display:inline'])}}
                {{ Form::submit('Eliminar')}}
                {{ Form::close()}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
