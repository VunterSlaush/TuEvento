@extends('layouts.app')

@section('content')
  <div class="container">

    <h2> Crear evento</h2>
    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento','files' => 'true'))}}

    <ul class="collapsible" data-collapsible="accordion">
      <li>
        <div class="collapsible-header active"><i class="material-icons">assignment</i> Información Base*</div>
        <div class="collapsible-body">
          <div class="container form-container">
            <div class="row">
              <div class="col m4">
                  {{Form::label('image','Imagen')}}
                  <div id="event-image"
                  style="background-image:url(https://cdn3.iconfinder.com/data/icons/faticons/32/picture-01-256.png);
                          background-size:cover;
                          width: 150px;
                          height:150px;
                          background-position:center;">
                  </div>
                  <input name="image" type="file" id="image" style="display:none;">
                  <a class="btn waves-light col m12"href="#!" onclick="inputImageClick();"> Seleccionar</a>
              </div>
              <div class="col m8">
                <div class="col m12">
                  {{Form::label('nombre','Nombre*')}}
                  {{Form::text('nombre')}}
                </div>
                <div class="col m12">
                  {{Form::label('lugar','Lugar*')}}
                  {{Form::text('lugar')}}
                </div>

                  <div class="col m12">
                      <input type="checkbox" id="certificado_por_actividad" name="certificado_por_actividad" />
                      <label for="certificado_por_actividad">Certificado Por Actividad</label>
                  </div>

              </div>
            </div>
            <div class="row">
              <div class="col m6">
                {{Form::label('fecha_inicio','Fecha de Inicio*')}}
                {{Form::date('fecha_inicio','',array('class' => 'datepicker'))}}
              </div>
              <div class="col m6">
                {{Form::label('fecha_fin','Fecha Final*')}}
                {{Form::date('fecha_fin','',array('class' => 'datepicker'))}}
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
                </div>
              </div>
              <div class="row" id="area_wrapper">
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
                  <input type="text"  name="" id='tipo-vacante'>
                </div>
                <div class="col m3">
                  <input type="checkbox" id="tipo-evaluable" name="" />
                  <label for="tipo-evaluable">Evaluable</label>
                </div>
                <div class="col m2">
                  <a class="waves-effect waves-light btn-floating" id="add_tipo" name="add_tipo"><i class="material-icons">add</i></a>
                </div>
              </div>
              <div class="row" id="tipo_wrapper">
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>

      <div class="row">
        {{Form::submit('Crear')}}
      </div>
        {{Form::close()}}
    </div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Listo',
    format: 'mm-dd-yyyy'
  });
  Materialize.updateTextFields();
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper_area         = $("#area_wrapper"); //Fields wrapper
    var wrapper_tipo         = $("#tipo_wrapper"); //Fields wrapper
    var add_button_area      = $("#add_area"); //Add button ID
    var add_button_tipo      = $("#add_tipo");
    var area_input           = $("#area-info");
    var tipo_nombre           = $("#tipo-nombre");
    var tipo_vacante           = $("#tipo-vacante");
    var tipo_evaluable           = $("#tipo-evaluable");
    var areas = 0; //initlal text box count
    var tipos = 0;
    $(add_button_area).click(function(e){ //on add input button click
        e.preventDefault();
        if(areas < max_fields && area_input.val()){ //max input box allowed
          area_input.removeClass("invalid");
            $(wrapper_area).append('<span>'+
                                '<input class="validate" type="text"  name="area['+areas+']" id="area['+areas+']" value="'+ area_input.prop("value")+'" style="display:none;">'+
                                '<div class="chip">'+ area_input.prop('value') +' <i class="close material-icons"> close </i> </div>' +
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
                                  '<div class="chip" style="background-color: #1565C0 !important; color:#fff">'+ tipo_vacante.prop('value') +' | '+ tipo_nombre.prop('value') +' <i class="close material-icons"> close </i> </div>' +
                                  '</span>');
          }else{
            $(wrapper_tipo).append('<span>'+
                                  '<input class="validate" type="text"  name="tipo['+tipos+']" id="tipo['+tipos+']" value="'+ tipo_nombre.prop("value")+'" style="display:none;"/>'+
                                  '<input class="validate" type="number"  name="tipo_cantidad['+tipos+']" id="tipo_cantidad['+tipos+']" value="'+ tipo_vacante.prop("value")+'" style="display:none;"/>'+
                                  '<input type="text" id="tipo_evaluable['+tipos+']" name="tipo_evaluable['+tipos+']" value="'+ tipo_evaluable.prop("checked")+'" style="display:none;"/>'+
                                  '<div class="chip">'+ tipo_vacante.prop('value') +' | '+ tipo_nombre.prop('value') +' <i class="close material-icons"> close </i> </div>' +
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
        areas--;
    });

    $(wrapper_tipo).on("click",".close", function(e)
    { //user click on remove text
        e.preventDefault(); $(this).parent().parent('span').remove();
        tipos--;
    });

    $("input[name='image']").change(function() {
        readURL(this);
    });

    $("form").submit(function() {
      console.log("hola borrando el form que no va pal baile");
      $(this).children("#area-info").remove();
    });


});

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
