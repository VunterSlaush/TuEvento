@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> {{$nombre_evento}}</h1>
    <h4> Crear actividad</h4>

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
          <!-- Modal Trigger -->
          <a class="waves-effect waves-light btn" href="#modal1">
          <i class="material-icons left">schedule</i>ver</a>
        </div>
        <div class="col m4">
          {{Form::label('hora_inicio','Hora de Inicio')}}
          {{Form::time('hora_inicio','00:00',array('class' => 'timepicker'))}}
        </div>
        <div class="col m4">
          {{Form::label('hora_fin','Hora de Finaliz.')}}
          {{Form::time('hora_fin','00:00',array('class' => 'timepicker'))}}
        </div>
      </div>

      <div class="row">
        <div class="col m8">
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
            <option value="" disabled selected>Áreas</option>
            @foreach ($evento->areas as $area)
                <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field col m6">
          <select name='tipo_actividad' id='tipo_actividad'>
            <option value="" disabled selected>Tipo de Actividades</option>
            @foreach ($evento->tipoActividad as $tipo)
                <option value="{{ $tipo->tipoActividad->nombre }}">{{ $tipo->tipoActividad->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <center>{{Form::submit('Crear',['class' => 'waves-effect waves-light btn'])}}</center>

      {{Form::close()}}
    </div>

    <!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Horarios de Actividades</h4>
      <ul class="row collection">
        @foreach($actividad as $key => $value)
        <li class="collection-item avatar col m4">
          <p>&nbsp;</p>
          <i class="material-icons circle" style="color:#1565c0;">description</i>
          <span class="title">{{$value->titulo}}</span>
          <p>Fecha: {{$value->fecha}} <br>
              Hora de Inicio: {{$value->hora_inicio}} <br>
              Hora de Finalización: {{$value->hora_fin}}
          </p>
          <p>&nbsp;</p>
        </li>
        @endforeach
      </ul>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">De acuerdo</a>
    </div>
  </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

  $(document).ready(function() {
      $('.timepicker').clockpicker({
        autoclose: true,
        twelvehour: false,
        donetext: 'Aceptar'
      });

    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Listo',
      format: 'dd-mm-yyyy'
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
    $("#tipo_actividad, #area").material_select();
  });
</script>

<script>
   $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>

@endsection
