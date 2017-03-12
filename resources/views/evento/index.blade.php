@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="#" class="breadcrumb"> Mis Eventos</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3 > Mis Eventos</h3>
    </div>
  </div>
  <div class="content-body">
    <div class="container">
      <table id="event_table">
      <thead>
        <tr>
          <th> Nombre </th>
          <th> Lugar </th>
          <th  class="hide-on-small-only"> Inicio </th>
          <th  class="hide-on-small-only"> Fin </th>
          <th> Estado </th>
          <th> Acciones </th>
        </tr>
      </thead>

      <tbody>
        @foreach($evento as $key => $value)
        <tr>
          <td> {{$value->nombre}}</td>
          <td> {{$value->lugar}}</td>
          <td class="hide-on-small-only"> {{$value->fecha_inicio}}</td>
          <td class="hide-on-small-only"> {{$value->fecha_fin}}</td>
          <td> {{$value->estado}}</td>

          <td class="action">
            <a class='dropdown-button btn' href='#'><i class="material-icons">settings</i></a>
            <!-- Dropdown Structure -->
            <ul class='dropdown-content'>
              <li><a href="{{route('evento.show',$value->id)}}">Mostrar</a></li>
              @can('modify',$value)
                <li><a href="{{route('evento.edit',$value->id)}}">Editar</a></li>
                <li><a href="javascript:deleteEvent('{{ $value->id }}');" data-method="delete">Eliminar</a></li>
              @endcan
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
