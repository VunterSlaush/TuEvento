@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> Actividades</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3> Actividades </h3>
      <h4> {{$evento->nombre}}</h4>
    </div>
  </div>
  <div class="content-body">
    <div class="container">
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
                <li><a href="{{route('evento.actividad.show',[$evento->id,$value->id])}}"> Mostrar</a></li>
                @can('modify',$value)
                  <li><a href="{{route('evento.actividad.edit',[$evento->id,$value->id])}}"> Editar</a></li>
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

    var $grid = $('.event-grid').isotope({
      itemSelector: '.event-item',
      layoutMode: 'fitRows',
      getSortData:{
        titulo:'.titulo',
        fecha:'.fecha',
      }
    });

    $('#sorts').on('click','input',function() {
      var sortByValue = $(this).attr('data-sort-by');
      $grid.isotope({sortBy: sortByValue});
    });

    $('#filters').on('click','input',function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({filter:filterValue});
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
