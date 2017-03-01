@extends('layouts.app')

@section('content')
  <div class="container">


    <div class="row">
      <div class="col m5">
            <h3>Crear Pregunta</h3>
      </div>
    {{Form::open(array('url' => 'evento/'.$evento->id.'/storePregunta'))}}
      <div class="col m7" style="margin-top:30px;">
          <div class="col m4">
            <a class="waves-effect waves-light btn" type="subimit">Finalizar</a>
          </div>
          <input type="hidden" name="json" value="false">
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
        {{Form::close()}}
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
  var id_evento = {!!$evento->id!!};
  var opciones = [];
  function validarOpciones()
  {
    var error = false;
    if($('#pregunta').val() == '')
      error = true;

    var divs = $("#opcion_wrapper").find()
    $("#opcion_wrapper div").each(function( index ) {
        var option_form = $(this).find($(".option"));
        var option_value_form = $(this).find($(".option_value"));
        opciones.push({opcion:option_form.val(), valor: option_value_form.val()});
        if(option_form.val() == '')
          error = true;
        if(option_value_form.val() == '')
          error = true;
        console.log(opciones);
      });
      if(error)
      {
         Materialize.toast('Error en el Formulario', 3000, 'rounded red');
         return false;
      }
      return true;
  }

  function enviarPregunta()
  {
    if(validarOpciones())
    {
      $.ajax({
      url: '/evento/'+id_evento+'/storePregunta',
      type: 'POST',
      data: {_token: CSRF_TOKEN, json:true, pregunta:$('#pregunta').val(), opciones:opciones},
      dataType: 'JSON',
      success: function (data)
      {
        console.log(data);
        if(data.msg)
          Materialize.toast(data.msg, 3000, 'red rounded');
        else
        {
          Materialize.toast('Pregunta Añadida', 3000, 'blue rounded');
        }
    }
  }
</script>
@endsection
