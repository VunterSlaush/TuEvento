@extends('layouts.app')
@section('content')
<div class="content-head col s12">
  <nav id="breadcrumb-nav" class="hide-on-med-and-down">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
        <a href="{{ route('evento.show',$actividad->evento->id)}}" class="breadcrumb"> {{$actividad->evento->nombre}}</a>
        <a href="#" class="breadcrumb"> {{$actividad->titulo}}</a>
        <a href="#" class="breadcrumb"> Verificar Asistencia</a>
      </div>
    </div>
  </nav>
<div class="container">
    <h3>  Verificar Asistencia</h3>
  </div>
</div>

<div class="content-body">
  <div class="container">
    <div class="col m4">
      <select name='id_user' class="js-example-data-ajax" id="seleccionado">
      </select>
    </div>
  </div>
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
        ajax: {
          url: function (params) {
            return "/users/"+params.term+"/"+id_actividad;
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
          url: '/marcarAsistencia',
          type: 'POST',
          data: {_token: CSRF_TOKEN,cedula:$('#seleccionado').val(), id_actividad:id_actividad},
          dataType: 'JSON',
          success: function (data)
          {
            if(data.msg)
              Materialize.toast(data.msg, 3000, 'rounded');
            else
              Materialize.toast('Asistencia Marcada', 3000, 'rounded');
            $('#seleccionado').empty();
          }
          });

        });
  </script>
@endsection
