@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Eventos</h1>

    <table>
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
          <td>
            <a class='dropdown-button btn' href='#' data-activates='dropdown1'><i class="material-icons">settings</i></a>

            <!-- Dropdown Structure -->
            <ul id='dropdown1' class='dropdown-content'>
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
