@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="#" class="breadcrumb"> Mi Horario</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3>  Mi Horario</h3>
    </div>
  </div>

  <div class="content-body">
    <div class="container">
      <table id="event_table">
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
          <tr id='asiste{{$value->id}}'>
            <td> {{$value->ponente}}</td>
            <td> {{$value->titulo}}</td>
            <td> {{$value->fecha}}</td>
            <td> {{$value->hora_inicio}}</td>
            <td> {{$value->hora_fin}}</td>
            <td class ='action'>
              <a class='dropdown-button btn' href='#'><i class="material-icons">settings</i></a>
              <ul class='dropdown-content'>
                <li><a <a href="{{route('actividad.show',$value->id_actividad)}}"> Ver Actividad</a></li>
                <li><a href="javascript:deleteAsistencia('{{ $value->id }}');" data-method="delete">No Asistir</a></li>
              </ul>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('scripts')
  <script type="text/javascript">
  $(".action").each(function(i) {
    $(this).find("a.dropdown-button").attr('data-activates','dropdown_'+ i);
    $(this).find("ul.dropdown-content").attr('id','dropdown_' +i );
  });

    function deleteAsistencia(id)
    {

          $.ajax({
              type: "DELETE",
              data: {_token: CSRF_TOKEN},
              url: '/asiste/' + id, //resource
              success: function(affectedRows) {
                  console.log(affectedRows);
                  $('#asiste'+id).remove();
              }
          });
    }
  </script>
@endsection
