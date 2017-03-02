@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
        <div class="col m5">
              <h3>Crear Encuesta</h3>
        </div>
        <div class="col m4" style="margin-top:30px;">
          <div class="switch" >
            <label>
              Satisfaccion
              <input type="checkbox"  id='tipo'>
              <span class="lever"></span>
              Evaluacion
            </label>
          </div>
        </div>

        <div class="col m3" style="margin-top:30px;">
              <a class="waves-effect waves-light btn" onclick="enviarEncuesta()">Guardar</a>
        </div>
      </div>
      <div class="row">
        <label>Nombre de la Encuesta</label>
        <input type="text" name="nombre" id="nombre">
      </div>

      <div class="row input-field">
      <select multiple id='preguntas'>
        <option value="" disabled selected>Preguntas</option>
        @foreach($evento->preguntas as $pregunta)
          <option value="{{$pregunta->id}}">{{$pregunta->pregunta}}</option>
        @endforeach
      </select>
      <label>Selecciona las Preguntas</label>
    </div>
</div>

@endsection

@section('scripts')
<script>
var id_evento = {!! $evento->id !!};
$(document).ready(function()
{
   $('select').material_select();
});

  function enviarEncuesta()
  {
    if($('#nombre').val() == '')
    {
      Materialize.toast('Ingrese un Nombre!', 3000, 'red rounded');
      return;
    }

    if($('#preguntas').val().length < 1)
    {
      Materialize.toast('Encuesta sin preguntas', 3000, 'red rounded');
      return;
    }

      $.ajax({
      url: '/evento/'+id_evento+'/storeEncuesta',
      type: 'POST',
      data: {_token: CSRF_TOKEN, nombre:$('#nombre').val(), preguntas:$('#preguntas').val(), tipo:$('#tipo').prop('checked'),id_evento:id_evento},
      dataType: 'JSON',
      success: function (data)
      {
        console.log(data);
        if(data.msg)
          Materialize.toast(data.msg, 3000, 'red rounded');
        else
        {
          Materialize.toast('Encuesta Guardada', 3000, 'blue rounded');
          $('#nombre').val('');
          $('#preguntas').empty();
          $('select').material_select();
          $('#tipo').prop('checked',false);
        }
      }});

  }
</script>
@endsection
