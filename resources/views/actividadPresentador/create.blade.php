@extends('layouts.app')
<!-- TODO quizas a;adir una lista de Usuarios? o Bajar las asistencias  -->
@section('content')
<div class="container">
  <h1> Asignar Presentador </h1>
  <div class="col m4">
    <select name='id_user' class="js-example-data-ajax" id="seleccionado">
    </select>
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
            if(data.msg)
              Materialize.toast(data.msg, 3000, 'rounded');
            else
              Materialize.toast('Presentador Añadido', 3000, 'rounded');
            $('#seleccionado').empty();
          }
          });

        });
  </script>
@endsection
