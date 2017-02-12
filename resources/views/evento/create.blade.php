@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Crear evento</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento'))}}
    <div class="row">
      <div class="col m6">
        {{Form::label('nombre','Nombre')}}
        {{Form::text('nombre')}}
      </div>
      <div class="col m6">
        {{Form::label('lugar','Lugar')}}
        {{Form::text('lugar')}}
      </div>
      <div class="col m6">
        {{Form::label('fecha_inicio','fecha_inicio')}}
        {{Form::date('fecha_inicio','\Carbon\Carbon::now()')}}
      </div>
      <div class="col m6">
        {{Form::label('fecha_fin','fecha_fin')}}
        {{Form::date('fecha_fin','\Carbon\Carbon::now()')}}
      </div>
      <div class="col m6">
        <p>
          <input type="checkbox" id="certificado_por_actividad" name="certificado_por_actividad" />
          <label for="certificado_por_actividad">Certificado Por Actividad</label>
        </p>
      </div>
      <div class="col m12">
        <div class="col m6">
              <h4>Areas de Conocimiento del Evento</h4>
        </div>
        <div class="col m6">
          <a class="waves-effect waves-light btn" id="add_area" name="add_area">Añadir area</a>
        </div>
      </div>

      <div class="row" id="area_wrapper">
        <div class="col m8">
          <p class="col m3">Nombre del Area</p>
          <input class="col m6" type="text"  name="area[0]" id='area[0]'>
          <a href="#" class="col m3 remove_field">Remove</a></div>
        </div>
      </div>


      <div class="col m12">
        <div class="col m6">
              <h4>Tipos de Actividades</h4>
        </div>
        <div class="col m6">
          <a class="waves-effect waves-light btn" id="add_tipo" name="add_tipo">Añadir Tipo</a>
        </div>
      </div>

      <div class="row" id="tipo_wrapper">
        <div class="row">
          <p class="col m2">Nombre del Tipo</p>
          <input class="col m2" type="text"  name="tipo[0]" id='tipo[0]'>
          <p class="col m2">Vacantes Disponibles</p>
          <input class="col m2" type="number"  name="tipo_cantidad[0]" id='tipo_cantidad[0]'>
          <div class="col m2">
            <p>
              <input type="checkbox" id="tipo_evaluable[0]" name="tipo_evaluable[0]" />
              <label for="tipo_evaluable[0]">Evaluable</label>
            </p>
          </div>
          <a href="#" class="col m2 remove_field">Remove</a>
        </div>

      </div>


      <div class="row">
        {{Form::submit('Crear')}}

        {{Form::close()}}
      </div>

    </div>

  </div>

@endsection

@section('scripts')
<script>

$(document).ready(function(){

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper_area         = $("#area_wrapper"); //Fields wrapper
    var wrapper_tipo         = $("#tipo_wrapper"); //Fields wrapper
    var add_button_area      = $("#add_area"); //Add button ID
    var add_button_tipo      = $("#add_tipo");

    var areas = 1; //initlal text box count
    var tipos = 1;
    $(add_button_area).click(function(e){ //on add input button click
        e.preventDefault();
        if(areas < max_fields){ //max input box allowed
            areas++; //text box increment
            $(wrapper_area).append('<div class="col m8">'+
                                '<p class="col m3">Nombre del Area</p>'+
                                '<input class="col m6" type="text"  name="area['+areas+']" id="area['+areas+']">'+
                                '<a href="#" class="col m3 remove_field">Remove</a></div>'+
                              '</div>');
        }
    });

    $(add_button_tipo).click(function(e){ //on add input button click
        e.preventDefault();
        if(tipos < max_fields){ //max input box allowed
            tipos++; //text box increment
            $(wrapper_tipo).append('<div class="row">'+
                                '<p class="col m2">Nombre del Tipo</p>'+
                                '<input class="col m2" type="text"  name="tipo['+tipos+']" id="tipo['+tipos+']">'+
                                '<p class="col m2">Vacantes Disponibles</p>'+
                                '<input class="col m2" type="number"  name="tipo_cantidad['+tipos+']" id="tipo_cantidad['+tipos+']">'+
                                '<div class="col m2">'+
                                  '<p>'+
                                    '<input type="checkbox" id="tipo_evaluable['+tipos+']" name="tipo_evaluable['+tipos+']" />'+
                                    '<label for="tipo_evaluable['+tipos+']">Evaluable</label>'+
                                  '</p>'+
                                '</div>'+
                                '<a href="#" class="col m2 remove_field">Remove</a></div>'+

                              '</div>');
        }
    });

    $(wrapper_area).on("click",".remove_field", function(e)
    { //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
        areas--;
    });

    $(wrapper_tipo).on("click",".remove_field", function(e)
    { //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
        tipos--;
    })

});

</script>
@endsection
