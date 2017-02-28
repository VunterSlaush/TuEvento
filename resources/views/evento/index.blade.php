@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Eventos</h1>

    <table id="event_table">
      <thead>
        <tr>
          <th> Creador </th>
          <th> Nombre </th>
          <th> Lugar </th>
          <th> Inicio </th>
          <th> Fin </th>
          <th> Estado </th>
          <th> Acciones </th>
        </tr>
      </thead>

      <tbody>
        @foreach($evento as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->nombre}}</td>
          <td> {{$value->lugar}}</td>
          <td> {{$value->fecha_inicio}}</td>
          <td> {{$value->fecha_fin}}</td>
          <td> {{$value->estado}}</td>

          <td class="action">
            <a class='dropdown-button btn' href='#'><i class="material-icons">settings</i></a>
            <!-- Dropdown Structure -->
            <ul class='dropdown-content'>
              <li><a href="{{route('evento.show',$value->id)}}"> Mostrar</a></li>
              @can('modify',$value)
                <li><a href="{{route('evento.edit',$value->id)}}"> Editar</a></li>
                <li><a href="javascript:deleteEvent('{{ $value->id }}');" data-method="delete">Eliminar</a></li>
              @endcan
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

    $(document).ready(function(){
      $('#event_table').DataTable();
    });

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
              url: '/evento/' + id, //resource
              success: function(affectedRows) {
                  console.log(affectedRows);
                  location.reload(true);
              }

          });
      }
    }
  </script>
@endsection
