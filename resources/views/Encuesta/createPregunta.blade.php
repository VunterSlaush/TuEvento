@extends('layouts.app')

@section('content')
  <div class="container">


    <div class="row">
      <div class="col m5">
            <h3>Crear Pregunta</h3>
      </div>
    {{Form::open(array('url' => 'evento//storePregunta'))}}
      <div class="col m7" style="margin-top:30px;">
          <div class="col m4">
            <a class="waves-effect waves-light btn">Finalizar</a>
          </div>
          <div class="col m8">
            <a class="waves-effect waves-light btn" onclick="enviarPregunta()">Añadir Otra Pregunta</a>
          </div>
      </div>
    </div>




    <div class="row">
      <label>Pregunta</label>
      <input type="text" name="pregunta" id="pregunta">
    </div>
    <div class="row">
      <div class="col m5">
            <h3>Opciones</h3>
      </div>
      <div class="col m6" style="margin-top:30px;">
          <a class="waves-effect waves-light btn" id='add_opcion'>Añadir Opcion</a>
      </div>
    </div>



      <div class="row" id="opcion_wrapper" style="height:250px; overflow-y:auto; overflow-x:hidden;">
        <div class="row">
          <p class="col m2">Opcion</p>
          <input class="col m2 option" type="text"  name="opcion[0]" id='opcion[0]'>
          <p class="col m2">Valor</p>
          <input class="col m2 option_value" type="number"  name="opcion_cantidad[0]" id='opcion_cantidad[0]'>
          <a href="#" class="col m1 btn remove_field"><i class="material-icons">delete</i></a>
        </div>
      </div>


  </div>

@endsection

@section('scripts')
<script>
  $(document).ready(function(){
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper_opcion         = $("#opcion_wrapper"); //Fields wrapper
    var add_button_opcion      = $("#add_opcion"); //Add button ID
    var opciones = 1; //initlal text box count
    $(add_button_opcion).click(function(e){ //on add input button click
        e.preventDefault();
        if(opciones < max_fields){
            $(wrapper_opcion).append('<div class="row">'+
                      '<p class="col m2">Opcion</p>'+
                      '<input class="col m2 option" type="text"  name="opcion['+opciones+']" id="opcion['+opciones+']">'+
                      '<p class="col m2">Valor</p>'+
                      '<input class="col m2 option_value" type="number"  name="opcion_cantidad['+opciones+']" id="opcion_cantidad['+opciones+']">'+
                      '<a href="#" class="col m1 btn remove_field"><i class="material-icons">delete</i></a>'+
                    '</div>');
                      opciones++;
        }
    });

    $(wrapper_opcion).on("click",".remove_field", function(e)
    { //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
        opciones--;
    });

});

  function enviarPregunta()
  {
    var opciones = [];
    var divs = $("#opcion_wrapper").find()
    $( "#opcion_wrapper div" ).each(function( index ) {
        console.log($(this));
        var option_form = $(this).find($(".option"));
        console.log(option_form.val());
        opciones.push()
      });
  }
</script>
@endsection
