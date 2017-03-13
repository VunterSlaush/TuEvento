@extends('layouts.app')

@section('content')
  <div class="content-head col s12">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> Editar Actividad </a>
        </div>
      </div>
    </nav>
    <div class="container">
      <h3>  {{title_case($evento->nombre)}}</h3>
      <h4> Editar actividad: {{title_case($actividad->titulo)}}</h4>
    </div>
  </div>

  <div class="content-body">
    <div class="container">
      {{Html::ul($errors->all())}}

      {{Form::model($actividad, array('route' => array('evento.actividad.update',$evento->id,$actividad->id), 'method' => 'PUT'))}}
      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header active"><i class="material-icons">assignment</i> Información Base*</div>
          <div class="collapsible-body">
            <div class="container form-container">
              <div class="row">
                <div class="col m6">
                  {{Form::label('titulo','Titulo')}}
                  {{Form::text('titulo')}}
                </div>
                <div class="col m6">
                  <label for='id_user'>ponente</label>
                  <select name='id_user' class="js-example-data-ajax" id="ponente">
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col m12 input-field">
                  {{Form::label('resumen','Resumen')}}
                  {{Form::textArea('resumen',$actividad->resumen,array('class' => 'materialize-textarea','data-length' => '255','maxlength' => '255'))}}
                </div>
              </div>
            </div>
          </div>
        </li>
        <li>
          <div class="collapsible-header active"><i class="material-icons">assignment</i> Fecha y Hora</div>
          <div class="collapsible-body">
            <div class="container form-container">
              <div class="row">
                <div class="col m4">
                  {{Form::label('fecha','Fecha')}}
                  {{Form::date('fecha',$actividad->fecha,array('class' => 'datepicker'))}}
                </div>
                <div class="col m4">
                  {{Form::label('hora_inicio','Hora de Inicio')}}
                  {{Form::time('hora_inicio',$actividad->hora_inicio,array('class' => 'timepicker'))}}
                </div>
                <div class="col m4">
                  {{Form::label('hora_fin','Hora de Finaliz.')}}
                  {{Form::time('hora_fin',$actividad->hora_fin,array('class' => 'timepicker'))}}
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      {{Form::submit('Editar',['class' => 'waves-effect waves-light btn'])}}

      {{Form::close()}}
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
@endsection
