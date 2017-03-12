@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> Asignar Jurado</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3>  Asignar Jurado</h3>
    </div>
  </div>

  <div class="content-body">
    <div class="container">
      <div class="row">
        <div class="col m6">
          <label for="id_user"> Usuario</label>
          <select name='id_user' class="js-example-data-ajax" id="seleccionado" disabled>
          </select>
        </div>
        <div class="input-field col m4">
          <select name='area' id="area">
            <option value="" disabled selected>Selecciona un Area</option>
            @foreach ($evento->areas as $area)
                <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
            @endforeach
          </select>
          <label>Selecciona un Area</label>
        </div>
        <div class="col m2">
          <a class='btn' href='#' onclick="guardarJurado();"><i class="material-icons">send</i></a>
        </div>
      </div>


      <table id="event_table">
        <thead>
          <tr>
            <th> Nombre </th>
            <th> Cedula </th>
            <th> Area </th>
          </tr>
        </thead>

        <tbody>
          @foreach($evento->jurados as $key => $value)
          <tr id="jurado{{$value->id}}">
            <td> {{$value->user->nombre}}</td>
            <td> {{$value->user->cedula}}</td>
            <td id="area_jurado{{$value->id}}">
                @foreach($value->areas as $area)
                <div class="chip">
                  {{$area->area->nombre}}
                  <i class="close material-icons" onclick="removeAreaFromUser({{$area}})">close</i>
                </div>
                @endforeach
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
  $(document).ready(function() {
    $("#area").material_select();
  });
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
            return "/users/"+params.term;
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

  function guardarJurado()
  {
    $.ajax({
    url: '/evento/'+id_evento+'/jurado',
    type: 'POST',
    data: {_token: CSRF_TOKEN, id_user:$('#seleccionado').val(), id_evento:id_evento, area:$('#area').val()},
    dataType: 'JSON',
    success: function (data) // TODO no prioritario, a;adir el jurado a la tabla aqui! data trae user, jurado y area!
    {
      if(data.msg)
        Materialize.toast(data.msg, 3000, 'rounded');
      else
      {
        Materialize.toast('Jurado Añadido', 3000, 'rounded');
        location.reload();
      }
      $('#seleccionado').empty();
      $('#area').empty();
      $('#seleccionad').prop("disabled",true);
    }
    });
  }

  function removeAreaFromUser(area)
  {
    $.ajax({
    url: '/deleteJuradoArea',
    type: 'POST',
    data: {_token: CSRF_TOKEN, id_area:area.id_area, id_jurado:area.id_jurado},
    dataType: 'JSON',
    success: function (data)
    {
      console.log(data);
      if($('#area_jurado'+area.id_jurado).children().length <= 1)
          $('#jurado'+area.id_jurado).remove();
          console.log($('#area_jurado'+area.id_jurado).children().length);
        Materialize.toast('Jurado Eliminado', 3000, 'rounded');
    }
    });

  }

  $( "#area" ).change(function() {
    if($(this).val() != '')
      $('#seleccionado').prop("disabled", false);
    else {
      $('#seleccionado').prop("disabled", true);
    }
  });


</script>
@endsection
