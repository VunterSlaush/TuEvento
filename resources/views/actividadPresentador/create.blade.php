@extends('layouts.app')
<!-- TODO quizas a;adir una lista de Usuarios? o Bajar las asistencias  -->
@section('content')
<div class="container">
  <nav id="breadcrumb-nav">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="{{ route('evento.actividad.show',[$actividad->id_evento,$actividad->id])}}" class="breadcrumb"> {{$actividad->titulo}}</a>
        <a href="#" class="breadcrumb"> Presentador </a>
      </div>
    </div>
  </nav>
  <h1> Asignar Presentador </h1>
  <div class="col m4">
    <select name='id_user' class="js-example-data-ajax" id="seleccionado">
    </select>
  </div>
  <table id="presentador_table">
    <thead>
      <tr>
        <th> Nombre </th>
        <th> Cedula </th>
        <th> ¿Eliminar? </th>
      </tr>
    </thead>

    <tbody>
      @foreach($actividad->presentadores as $key => $value)
      <tr id="presentador{{$value->id}}">
        <td> {{$value->user->nombre}}</td>
        <td> {{$value->user->cedula}}</td>
        <td>
            <a class='btn' href='#' onclick="eliminarPresentador({{$value->id}});"><i class="material-icons">delete</i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
  var id_actividad = {!! $actividad->id !!};
  function formatRepo (user)
  {
    if(user.loading) return user.cedula;
    var markup = "<div class = 'collection-item'>" +
                    "<div>" + user.nombre + "</div>" +
                    "<div>" + user.cedula + "</div>"+
                "</div>";
    return markup;
  }

  function formatRepoSelection (user)
  {
    return user.cedula;
  }


  $(".js-example-data-ajax").select2({
        language: "es",
        ajax: {
          url: function (params) {
            return "/usersPresentador/"+params.term+"/"+id_actividad;
          },
          dataType: 'json',
          delay: 250,
          data:{_token: CSRF_TOKEN},
          processResults: function (data)
          {
            _.each(data.results, function (item) { item.id = item.cedula; });
            return {
              results: data.results,
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 3,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
      });

      $(".js-example-data-ajax").on("select2:select", function (e)
        {
          $.ajax({
          url: '/actividad/'+id_actividad+'/presentador',
          type: 'POST',
          data: {_token: CSRF_TOKEN,id_user:$('#seleccionado').val(), id_actividad:id_actividad},
          dataType: 'JSON',
          success: function (data)
          {
            console.log(data);
            if(data.msg)
              Materialize.toast(data.msg, 3000, 'rounded red');
            else
            {
              Materialize.toast('Presentador Añadido', 3000, 'rounded blue');
              $('#presentador_table tbody').append('<tr id=presentador'+data.presentador.id+'>'+
                                '<td>'+data.user.nombre+'</td>'+
                                '<td>'+data.user.cedula+'</td>'+
                                '<td>'+
                                    '<a class="btn" href="#" onclick="eliminarPresentador('+data.presentador.id+');">'+
                                    '<i class="material-icons">delete</i></a>'+
                                '</td>'+
                                              +'</tr>');
            }

            $('#seleccionado').empty();
          }
          });

        });

        function eliminarPresentador(presentador)
        {
          $.ajax({
          url: '/actividad/'+id_actividad+'/presentador/'+presentador,
          type: 'DELETE',
          data: {_token: CSRF_TOKEN},
          dataType: 'JSON',
          success: function (data) // TODO no prioritario, a;adir el jurado a la tabla aqui! data trae user, jurado y area!
          {
            console.log(data);
            if(data.msg)
              Materialize.toast(data.msg, 3000, 'blue rounded');
            else
            {
              Materialize.toast('Presentador Eliminado', 3000, 'blue rounded');
              $('#presentador'+presentador).remove();
            }
          }
          });
        }
  </script>
@endsection
