@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Evento: {{$nombre_evento}}</h1>
    <h2> Crear actividad</h2>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$evento->id.'/actividad'))}}

    <div class="container">
      <div class="row">
        <div class="col m6">
          {{Form::label('titulo','Titulo')}}
          {{Form::text('titulo')}}
        </div>
        <div class="col m6">
          {{Form::label('fecha','Fecha')}}
          <input type="date" name="fecha" id="fecha" class="datepicker">
        </div>
      </div>

      <div class="row">
        <div class="col m4">
          {{Form::label('hora_inicio','Hora de Inicio')}}
          {{Form::time('hora_inicio')}}
        </div>
        <div class="col m4">
          {{Form::label('hora_fin','Hora de Finaliz.')}}
          {{Form::time('hora_fin')}}
        </div>
        <div class="col m4">
          <label for='id_user'>ponente</label>
          <select name='id_user' class="js-example-data-ajax" id="ponente">
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col m12">
          {{Form::label('resumen','Resumen')}}
          {{Form::text('resumen')}}
        </div>
      </div>

      <div class="row">
        <div class="input-field col m6">
          <select name='area' id="area">
            <option value="" disabled selected>Selecciona un Area</option>
            @foreach ($evento->areas as $area)
                <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field col m6">
          <select name='tipo_actividad' id='tipo_actividad'>
            <option value="" disabled selected>Selecciona un Tipo de Actividad</option>
            @foreach ($evento->tipoActividad as $tipo)
                <option value="{{ $tipo->tipoActividad->nombre }}">{{ $tipo->tipoActividad->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>

      {{Form::submit('Crear')}}

      {{Form::close()}}
    </div>

  </div>
@endsection

@section('scripts')
<script type="text/javascript">

  $(document).ready(function() {

    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
    });

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
    $("#tipo_actividad, #area").material_select();
  });
</script>
@endsection
