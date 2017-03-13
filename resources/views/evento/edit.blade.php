@extends('layouts.app')

@section('content')

    <div class="content-head col s12">
      <nav id="breadcrumb-nav" class="hide-on-med-and-down">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="/home" class="breadcrumb"> Dashboard</a>
            <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
            <a href="#" class="breadcrumb"> Editar Evento {{title_case($evento->nombre)}}</a>
          </div>
        </div>
      </nav>
      <div class="container">
        <h3>Editar Evento</h3>
        <h4>{{title_case($evento->nombre)}}</h4>
      </div>
    </div>

  <div class="content-body">
    <div class="container">
      {{Html::ul($errors->all())}}
      {{Form::model($evento, array('route' => array('evento.update', $evento->id), 'method' => 'PUT'))}}

      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header active"><i class="material-icons">assignment</i> Información Base*</div>
          <div class="collapsible-body">
            <div class="container form-container">
              <div class="row">
                <div class="col m4">
                    {{Form::label('image','Imagen')}}
                    <div id="event-image"
                    style="background-image:url({{$evento->imagen}});
                            background-size:cover;
                            width: 150px;
                            height:150px;
                            background-position:center;">
                    </div>
                    <input name="image" type="file" id="image" style="display:none;">
                </div>
                <div class="col m8">
                  <div class="col m12">
                    {{Form::label('nombre','Nombre')}}
                    {{Form::text('nombre')}}
                  </div>
                  <div class="col m12">
                    {{Form::label('lugar','Lugar*')}}
                    {{Form::text('lugar')}}
                  </div>

                    <div class="col m12">
                        <input value="{{$evento->certificado_por_actividad}}"type="checkbox" id="certificado_por_actividad" name="certificado_por_actividad" />
                        <label for="certificado_por_actividad">Certificado Por Actividad</label>
                    </div>

                </div>
              </div>
              <div class="row">
                <div class="col m6">
                  {{Form::label('fecha_inicio','Fecha de Inicio*')}}
                  <input value="{{$evento->fecha_inicio}}" type="date" name="fecha_inicio" id="fecha_inicio" class="datepicker">
                </div>
                <div class="col m6">
                  {{Form::label('fecha_fin','Fecha Final*')}}
                  <input value="{{$evento->fecha_fin}}" type="date" name="fecha_fin" id="fecha_fin" class="datepicker">
                </div>
              </div>
            </div>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">book</i> Información de Area*</div>
          <div class="collapsible-body">
            <div class="container form-container">
              <div class="row">
                <div class="row">
                  <div class="col m8">
                    <label for="area-info">Nombre del Area</label>
                    <input type="text"  name="" id='area-info'>
                  </div>
                  <div class="col m4">
                    <a class="waves-effect waves-light btn-floating" id="add_area" name="add_area"><i class="material-icons">add</i></a>
                    <a class="waves-effect waves-light btn-floating" id="edit_area" name="add_area" style="display:none;"><i class="material-icons">edit</i></a>
                  </div>
                </div>
                <div class="row" id="area_wrapper">
                  @foreach ($evento->areas as $key => $area)
                    <span>
                      <input class="area-name validate" type="text"  name="area[{{$key}}]" id="area[{{$key}}]" value="{{$area->area->nombre}}" style="display:none;">
                      <input class="area-id" type="hidden" name="area_id[{{$key}}]" value="{{$area->area->id}}"/>
                      <div class="chip">
                        <a class="area-edit" href="#">{{$area->area->nombre}}</a>
                        <i class="close material-icons"> close </i> </div>
                    </span>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">description</i> Información de Tipo*</div>
          <div class="collapsible-body">
            <div class="container form-container">
              <div class="row">
                <div class="row">
                  <div class="col m3 offset-m1">
                    <label for="tipo-nombre">Nombre del Tipo</label>
                    <input type="text"  name="" id='tipo-nombre'>
                  </div>
                  <div class="col m2">
                    <label for="tipo-vacante">Vacantes</label>
                    <input type="number"  name="" id='tipo-vacante'>
                  </div>
                  <div class="col m3">
                    <input type="checkbox" id="tipo-evaluable" name="" />
                    <label for="tipo-evaluable">Evaluable</label>
                  </div>
                  <div class="col m2">
                    <a class="waves-effect waves-light btn-floating" id="add_tipo" name="add_tipo"><i class="material-icons">add</i></a>
                    <a class="waves-effect waves-light btn-floating" id="edit_tipo" name="edit_tipo" style="display:none;"><i class="material-icons">edit</i></a>
                  </div>
                </div>
                <div class="row" id="tipo_wrapper">
                  @foreach ($evento->tipoActividad as $key => $tipo)
                  <span>
                    <input class="validate tipo-nombre" type="text"  name="tipo[{{$key}}]" id="tipo[{{$key}}]" value="{{$tipo->tipoActividad->nombre}}" style="display:none;"/>
                    <input class="validate tipo-cantidad" type="number"  name="tipo_cantidad[{{$key}}]" id="tipo_cantidad[{{$key}}" value="{{$tipo->cant_maxima}}" style="display:none;"/>
                    <input class="tipo-evaluable" type="checkbox" id="tipo_evaluable[{{$key}}]" name="tipo_evaluable[{{$key}}]" value="{{$tipo->evaluable}}" style="display:none;"/>
                    <input class="tipo-id" type="hidden" name="tipo_id[{{$key}}]" value="{{$tipo->tipoActividad->id}}"/>
                    @if ($tipo->evaluable == true)
                      <div class="chip" style="background-color: #1565C0 !important; color:#fff"> <a class="tipo-edit" style="color:#fff" href="#"> {{$tipo->cant_maxima}} | {{$tipo->tipoActividad->nombre}}</a> <i class="close material-icons"> close </i> </div>
                    @else
                      <div class="chip"><a class="tipo-edit" href="#"> {{$tipo->cant_maxima}} | {{$tipo->tipoActividad->nombre}}</a>  <i class="close material-icons"> close </i> </div>
                    @endif
                  </span>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <center>{{Form::submit('Editar', ['class' => 'waves-effect waves-light btn'])}}</center>

      {{Form::close()}}
    </div>
  </div>


@endsection

@section('scripts')
<script>
$(document).ready(function(){
  $("#certificado_por_actividad").prop('checked',{!! $evento->certificado_por_actividad!!});

  $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        format: 'dd-mm-yyyy'
      });

      var max_fields      = 10; //maximum input boxes allowed
      var wrapper_area         = $("#area_wrapper"); //Fields wrapper
      var wrapper_tipo         = $("#tipo_wrapper"); //Fields wrapper
      var add_button_area      = $("#add_area"); //Add button ID
      var add_button_tipo      = $("#add_tipo");
      var area_input           = $("#area-info");
      var tipo_nombre           = $("#tipo-nombre");
      var tipo_vacante           = $("#tipo-vacante");
      var tipo_evaluable           = $("#tipo-evaluable");
      var areas = {!!count($evento->areas)!!}; //initlal text box count
      var tipos = {!!count($evento->tipoActividad)!!};
      $(add_button_area).click(function(e){ //on add input button click
          e.preventDefault();
          if(areas < max_fields && area_input.val()){ //max input box allowed
            area_input.removeClass("invalid");
              $(wrapper_area).append('<span>'+
                                  '<input class="validate" type="text"  name="area['+areas+']" id="area['+areas+']" value="'+ area_input.prop("value")+'" style="display:none;">'+
                                  '<div class="chip"> <a class="area-edit" href="#!"> '+ area_input.prop('value') +' </a> <i class="close material-icons"> close </i> </div>' +
                                '</span>');
              area_input.prop('value',"");
              areas++; //text box increment
          }else{
            area_input.addClass("invalid");
          }
      });
      $(add_button_tipo).click(function(e){ //on add input button click
          e.preventDefault();
          if(tipos < max_fields && tipo_nombre.val() && tipo_vacante.val()){ //max input box allowed
            tipo_nombre.removeClass("invalid");
            tipo_vacante.removeClass("invalid");

            if (tipo_evaluable.prop('checked') == true){
              $(wrapper_tipo).append('<span>'+
                                    '<input class="validate" type="text"  name="tipo['+tipos+']" id="tipo['+tipos+']" value="'+ tipo_nombre.prop("value")+'" style="display:none;"/>'+
                                    '<input class="validate" type="number"  name="tipo_cantidad['+tipos+']" id="tipo_cantidad['+tipos+']" value="'+ tipo_vacante.prop("value")+'" style="display:none;"/>'+
                                    '<input type="text" id="tipo_evaluable['+tipos+']" name="tipo_evaluable['+tipos+']" value="'+ tipo_evaluable.prop("checked")+'" style="display:none;"/>'+
                                    '<div class="chip" style="background-color: #1565C0 !important; color:#fff"> <a class="tipo-edit" href="#" style="color:#fff"> '+ tipo_vacante.prop('value') +' | '+ tipo_nombre.prop('value') +'</a> <i class="close material-icons"> close </i> </div>' +
                                    '</span>');
            }else{
              $(wrapper_tipo).append('<span>'+
                                    '<input class="validate" type="text"  name="tipo['+tipos+']" id="tipo['+tipos+']" value="'+ tipo_nombre.prop("value")+'" style="display:none;"/>'+
                                    '<input class="validate" type="number"  name="tipo_cantidad['+tipos+']" id="tipo_cantidad['+tipos+']" value="'+ tipo_vacante.prop("value")+'" style="display:none;"/>'+
                                    '<input type="text" id="tipo_evaluable['+tipos+']" name="tipo_evaluable['+tipos+']" value="'+ tipo_evaluable.prop("checked")+'" style="display:none;"/>'+
                                    '<div class="chip"> <a class="tipo-edit" href="#"> '+ tipo_vacante.prop('value') +' | '+ tipo_nombre.prop('value') +'</a> <i class="close material-icons"> close </i> </div>' +
                                    '</span>');
            }
              tipo_nombre.prop('value',"");
              tipo_vacante.prop('value',"");
              tipo_evaluable.prop('checked',false);
              tipos++; //text box increment
          }
      });
      $(wrapper_area).on("click",".close", function(e)
      { //user click on remove text
          e.preventDefault(); $(this).parent().parent('span').remove();

          edit_area_input = $(this).parent().parent().find('.area-name');
          current_id_input = $(this).parent().parent().find('.area-id');

          if (current_id_input.prop("value") != null){
            var data_out = JSON.stringify({
              id : current_id_input.prop("value"),
              nombre : edit_area_input.prop("value")
            });

            deleteArea(data_out);
            areas--;
          }
      });

      $(wrapper_area).on("click",".area-edit", function(e)
      { //user click on remove text
        e.preventDefault();
        area_input.removeClass("invalid");

        edit_area_input = $(this).parent().parent().find('.area-name');
        current_button = $(this);
        current_id_input = $(this).parent().parent().find('.area-id');
        area_input.prop('value',edit_area_input.prop('value'));

        $("#add_area").hide();
        $("#edit_area").show();
      });

      $("#edit_area").on("click",function(e) {
        e.preventDefault();
        edit_area_input.prop("value",area_input.prop("value"));
        current_button.text(area_input.prop("value"));

        var data_out = JSON.stringify({
          id : current_id_input.prop("value"),
          nombre : edit_area_input.prop("value")
        });

        updateArea(data_out);

        $("#add_area").show();
        $("#edit_area").hide();

        area_input.prop('value',"");
      });

      $(wrapper_tipo).on("click",".close", function(e)
      { //user click on remove text
          e.preventDefault(); $(this).parent().parent('span').remove();

          current_id_input = $(this).parent().parent().find('.tipo-id');

          if (current_id_input.prop("value") != null){
            var data_out = JSON.stringify({
              id : current_id_input.prop("value")
            });

            deleteTipo(data_out);
            tipos--;
          }
      });

      $(wrapper_tipo).on("click",".tipo-edit", function(e)
      { //user click on remove text
        e.preventDefault();
        tipo_nombre.removeClass("invalid");
        tipo_vacante.removeClass("invalid");

  // tipo_evaluable

        edit_tipo_nombre_input = $(this).parent().parent().find('.tipo-nombre');
        edit_tipo_cantidad_input = $(this).parent().parent().find('.tipo-cantidad');
        edit_tipo_evaluable_input = $(this).parent().parent().find('.tipo-evaluable');
        current_button = $(this);
        current_id_input = $(this).parent().parent().find('.tipo-id');

        tipo_nombre.prop('value',edit_tipo_nombre_input.prop('value'));
        tipo_vacante.prop('value',edit_tipo_cantidad_input.prop('value'));
        tipo_evaluable.prop('checked',edit_tipo_evaluable_input.prop('value'));

        $("#add_tipo").hide();
        $("#edit_tipo").show();
      });

      $("#edit_tipo").on("click",function(e) {
        e.preventDefault();
        edit_tipo_nombre_input.prop("value",tipo_nombre.prop("value"));
        edit_tipo_cantidad_input.prop("value",tipo_vacante.prop("value"));
        edit_tipo_evaluable_input.prop("value",tipo_evaluable.prop("checked"));
        current_button.text(edit_tipo_cantidad_input.prop("value") + " | " + edit_tipo_nombre_input.prop("value"));

        if (edit_tipo_evaluable_input.prop("value") == "false"){
          current_button.parent().removeAttr("style");
        }else{
          current_button.parent().prop("style","background-color: #1565C0 !important; color:#fff");
        }

        var data_out = JSON.stringify({
          id : current_id_input.prop("value"),
          nombre : edit_tipo_nombre_input.prop("value"),
          cant_maxima : edit_tipo_cantidad_input.prop("value"),
          evaluable : edit_tipo_evaluable_input.prop("value"),
        });

        updateTipo(data_out);
        //
        $("#add_tipo").show();
        $("#edit_tipo").hide();
        //
        // area_input.prop('value',"");
      });

      $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year
            format: 'dd-mm-yyyy'
          });

      $("input[name='image']").change(function() {
          readURL(this);
      });

      $("form").submit(function() {
        $(this).children("#area-info").remove();
      });
});


function updateArea(data_out)
{
      $.ajax({
      url: '/areaUpdate',
      type: 'POST',
      data: {_token:CSRF_TOKEN,area:data_out},
      dataType: 'JSON',
      success: function (data)
      {
          console.log(data.success);
      }
  });
}

function deleteArea(data_out)
{
      $.ajax({
      url: '/areaDelete',
      type: 'POST',
      data: {_token:CSRF_TOKEN,area:data_out},
      dataType: 'JSON',
      success: function (data)
      {
          console.log(data.success);
      }
  });
}

function updateTipo(data_out)
{
      $.ajax({
      url: '/tipoUpdate',
      type: 'POST',
      data: {_token:CSRF_TOKEN,tipo:data_out},
      dataType: 'JSON',
      success: function (data)
      {
          console.log(data.success);
      }
  });
}

function deleteTipo(data_out)
{
      $.ajax({
      url: '/tipoDelete',
      type: 'POST',
      data: {_token:CSRF_TOKEN,tipo:data_out},
      dataType: 'JSON',
      success: function (data)
      {
          console.log(data.success);
      }
  });
}

function inputImageClick() {
  $("input[name='image']").click();
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#event-image").css('background-image', 'url('+e.target.result+')');
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
