@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Actividades de: {{$nombre_evento}}</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table id="event_table">
      <thead>
        <th> Creador </th>
        <th> Fecha </th>
        <th> Titulo </th>
        <th> Inicio </th>
        <th> Fin </th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($actividad as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->fecha}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->hora_inicio}}</td>
          <td> {{$value->hora_fin}}</td>

          <td class="action">
            <a class='dropdown-button btn' href='#'><i class="material-icons">settings</i></a>
            <!-- Dropdown Structure -->
            <ul class='dropdown-content'>
              <li><a href="{{route('evento.actividad.show',[$id_evento,$value->id])}}"> Mostrar</a></li>
              @can('modify',$value)
                <li><a href="{{route('evento.actividad.edit',[$id_evento,$value->id])}}"> Editar</a></li>
                <li><a href="javascript:deleteEvent('{{ $value->id }}');" data-method="delete">Eliminar</a></li>
              @endcan
            </ul>
          </td>
          <!-- Old Evento actividad options
          <td>
            <a href="{{route('evento.actividad.show',[$id_evento,$value->id])}}"> Mostrar</a>
            @can('modify',$value)
              <a href="{{route('evento.actividad.edit',[$id_evento,$value->id])}}"> Editar</a>
              {{ Form::open(['method' => 'DELETE','route' => ['actividad.destroy', $value->id],'style'=>'display:inline'])}}
              {{ Form::submit('Eliminar')}}
              {{ Form::close()}}
            @endcan
          </td>
          -->

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
  
  <script type="text/javascript">

    $(".action").each(function(i) {
      $(this).find("a.dropdown-button").attr('data-activates','dropdown_'+ i);
      $(this).find("ul.dropdown-content").attr('id','dropdown_' +i );
    });


    function deleteEvent(id)
    {
      if (confirm('¿Seguro que desea Eliminar?')) {
          $.ajax({
              type: "DELETE",
              data: {_token: CSRF_TOKEN},
              url: '/actividad/' + id, //resource
              success: function(affectedRows) {
                  console.log(affectedRows);
                  location.reload(true);
              }

          });
      }
    }
  </script>
@endsection
