@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Tu Horario</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <th> Ponente</th>
        <th> Actividad</th>
        <th> Fecha</th>
        <th> Inicio </th>
        <th> Fin </th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($horario as $value)
        <tr>
          <td> {{$value->ponente}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->fecha}}</td>
          <td> {{$value->hora_inicio}}</td>
          <td> {{$value->hora_fin}}</td>
          <td>
            <a class='dropdown-button btn' href='#' data-activates='dropdown1'><i class="material-icons">settings</i></a>
            <ul id='dropdown1' class='dropdown-content'>
              <li><a <a href="{{route('actividad.show',$value->id_actividad)}}"> Ver Actividad</a></li>
              <li><a href="javascript:deleteAsistencia('{{ $value->id }}');" data-method="delete">No Asistir</a></li>
            </ul>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    function deleteAsistencia(id)
    {

          $.ajax({
              type: "DELETE",
              data: {_token: CSRF_TOKEN},
              url: '/asiste/' + id, //resource
              success: function(affectedRows) {
                  console.log(affectedRows);
                  location.reload(true);
              }
          });
    }
  </script>
@endsection
