@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Jurado:</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$evento->id.'/jurado'))}}

    <div class="row">
      <div class="col m6">
        <label for="id_user"> Usuario</label>
        <select name='id_user' class="js-example-data-ajax" id="seleccionado">
        </select>
      </div>
      <div class="input-field col m6">
        <select name='area' id="area">
          <option value="" disabled selected>Selecciona un Area</option>
          @foreach ($evento->areas as $area)
              <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
          @endforeach
        </select>
        <label>Selecciona un Area</label>
      </div>
    </div>
    <div class="row">
      {{Form::submit('Crear')}}
      {{Form::close()}}
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
        ajax: {
          url: function (params) {
            return "/usersEventoJurado/"+params.term+"/"+id_evento;
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
