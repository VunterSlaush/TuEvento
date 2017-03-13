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
            <th>Evento</th>
            <th>Demanda</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            @foreach($propuesta as $key => $value)
            <tr>
              <td> {{$value->evento->nombre}}</td>
              <td> {{$value->demanda}}</td>

              <td class="action">
                <a class='dropdown-button btn' href='#'><i class="material-icons">settings</i></a>
                <!-- Dropdown Structure -->
                <ul class='dropdown-content'>
                  <li><a href="{{route('evento.propuesta.show',[$value->evento->id,$value->id])}}"> Mostrar</a></li>
                  @can('modify',$value)
                    <li><a href="{{route('evento.propuesta.edit',[$value->evento->id,$value->id])}}"> Editar</a></li>
                    <li><a onclick="deletePropuesta('{{ $value->id }}')">Eliminar</a></li>
                  @endcan
                </ul>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('scripts')

  <script type="text/javascript">

    $(".action").each(function(i) {
      $(this).find("a.dropdown-button").attr('data-activates','dropdown_'+ i);
      $(this).find("ul.dropdown-content").attr('id','dropdown_' +i );
    });

    function deletePropuesta(id)
    {
      if (confirm('¿Seguro que desea Eliminar?')) {
          $.ajax({
              type: "DELETE",
              data: {_token: CSRF_TOKEN},
              url: '/propuesta/' + id, //resource
              success: function(affectedRows) {
                  console.log(affectedRows);
                  window.location.href = "/propuesta";
              },
              error : function ()
              {
                  window.location.href = "/propuesta";
              }
          });
      }
    }
    </script>
    @endsection
