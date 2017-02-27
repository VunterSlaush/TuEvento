@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Comite:</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$id_evento.'/comite'))}}

    <div class="row">
      <div class="col m6">
        <label for="id_user"> Usuario</label>
        <select name='id_user' class="js-example-data-ajax" id="seleccionado">
        </select>
      </div>
      {{Form::submit('Crear')}}
      {{Form::close()}}
    </div>

  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
  var id_evento = {!! $id_evento !!};
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

  </script>
@endsection
