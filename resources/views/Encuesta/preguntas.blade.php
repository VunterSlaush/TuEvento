@extends('layouts.app')

@section('content')

<div class="content-head col s12">
  <nav id="breadcrumb-nav" class="hide-on-med-and-down">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
        <a href="/evento/{{$evento->id}}" class="breadcrumb"> {{$evento->nombre}}</a>
        <a href="#" class="breadcrumb">Ver Preguntas</a>
      </div>
    </div>
  </nav>
  <div class="container">
    <h3> Ver Preguntas</h3>
  </div>
</div>
<div class="content-body">
  <div class="container">
    <table id="event_table">
      <thead>
        <tr>
          <th> Pregunta </th>
          <th> Acciones </th>
        </tr>
      </thead>

      <tbody>
        @foreach($preguntas as $key => $value)
        <tr id='p{{$value->id}}'>
          <td> {{$value->pregunta}}</td>
          <td class="action">
            <a class='dropdown-button btn' href='#'><i class="material-icons">settings</i></a>
            <ul class='dropdown-content'>
              <li><a href="#" onclick="verOpciones({{json_encode($value->opciones)}}, '{{$value->pregunta}}');">Ver Opciones</a></li>
              <li><a href="javascript:deletePregunta('{{ $value->id }}');" data-method="delete">Eliminar</a></li>
            </ul>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>



<!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4 id='modal-title'>Modal Header</h4>
      <ul class="collection" id='modal_content'>

      </ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script type="text/javascript">
  var borrados = [];
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    });

    $(".action").each(function(i) {
      $(this).find("a.dropdown-button").attr('data-activates','dropdown_'+ i);
      $(this).find("ul.dropdown-content").attr('id','dropdown_' +i );
    });

    function verOpciones(opciones, pregunta)
    {
        console.log(opciones);
        $('#modal-title').text(pregunta);
        $('#modal_content').empty();
        for (var i = 0; i < opciones.length; i++)
        {
          if(borrados.indexOf(opciones[i].id) === -1)
          {
            $('#modal_content').append('<li class="collection-item avatar" id="item-'+opciones[i].id+'">'+
                          '<i class="material-icons circle blue">grade</i>'+
                          '<h4>'+opciones[i].opcion+'</h4>'+
                          '<a href="#" onclick="borrarOpcion('+opciones[i].id+')" class="secondary-content"><i class="small material-icons">delete</i></a>'+
                          '</li>');
          }
        }
        $('#modal1').modal('open');
    }

    function borrarOpcion(id_opcion)
    {

      if (confirm('¿Seguro que desea Eliminar?')) {
          $.ajax({
              type: "POST",
              data: {_token: CSRF_TOKEN, id_opcion:id_opcion},
              url: '/borrarOpcion', //resource
              success: function(data)
              {
                $('#item-'+id_opcion).hide();
                borrados.push(id_opcion);// esto es un hack ..
              }
          });
      }
    }

    function deletePregunta(id_pregunta)
    {

            if (confirm('¿Seguro que desea Eliminar?')) {
                $.ajax({
                    type: "POST",
                    data: {_token: CSRF_TOKEN, id_pregunta:id_pregunta},
                    url: '/borrarPregunta', //resource
                    success: function(data)
                    {
                      $('#p'+id_pregunta).hide();
                    }
                });
            }
    }
  </script>
@endsection
