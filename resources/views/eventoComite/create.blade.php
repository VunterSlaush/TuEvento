@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Comite:</h1>
    <div class="row">
      <div class="col m6">
        <label for="id_user"> Usuario</label>
        <select name='id_user' class="js-example-data-ajax" id="seleccionado">
        </select>
      </div>
      <div class="col m4">
        <a class='btn' href='#' onclick="guardarComite();"><i class="material-icons">send</i></a>
      </div>
    </div>

    <table id="comite_table">
      <thead>
        <tr>
          <th> Nombre </th>
          <th> Cedula </th>
          <th> ¿Eliminar? </th>
        </tr>
      </thead>

      <tbody>
        @foreach($evento->comites as $key => $value)
        <tr id="comite{{$value->id}}">
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->user->cedula}}</td>
          <td>
              <a class='btn' href='#' onclick="eliminarComite({{$value->id}});"><i class="material-icons">delete</i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
  var id_evento = {!! $evento->id !!};
  //TODO formatRepo y formatRepoSelection moverlos a algo global ??
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
            return "/usersEventoComite/"+params.term+"/"+id_evento;
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

  function guardarComite()
  {
    $.ajax({
    url: '/evento/'+id_evento+'/comite',
    type: 'POST',
    data: {_token: CSRF_TOKEN, id_user:$('#seleccionado').val(), id_evento:id_evento},
    dataType: 'JSON',
    success: function (data) // TODO no prioritario, a;adir el jurado a la tabla aqui! data trae user, jurado y area!
    {
      console.log(data);
      if(data.msg)
        Materialize.toast(data.msg, 3000, 'blue rounded');
      else
      {
        Materialize.toast('Comite Añadido', 3000, 'blue rounded');
        $('#comite_table tbody').append('<tr id=comite'+data.comite.id+'>'+
                          '<td>'+data.user.nombre+'</td>'+
                          '<td>'+data.user.cedula+'</td>'+
                          '<td>'+
                              '<a class="btn" href="#" onclick="eliminarComite('+data.comite.id+');">'+
                              '<i class="material-icons">delete</i></a>'+
                          '</td>'+
                                        +'</tr>');
      }
      $('#seleccionado').empty();
    }
    });
  }

  function eliminarComite(comite)
  {
    $.ajax({
    url: '/evento/'+id_evento+'/comite/'+comite,
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
        Materialize.toast('Comite Eliminado', 3000, 'blue rounded');
        $('#comite'+comite).remove();
      }
    }
    });
  }
  </script>
@endsection
