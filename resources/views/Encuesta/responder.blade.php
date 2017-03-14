@extends('layouts.app')

@section('content')
  <div class="container">
    <h3>{{$encuesta->nombre}}</h3>
    <div class="slider">
       <ul class="slides">
         @foreach($encuesta->preguntas as $encuesta_pregunta)
            <li>
           <h5>{{$encuesta_pregunta->pregunta->pregunta}}</h5>
           <form action="#" id="p{{$encuesta_pregunta->pregunta->id}}">
           @foreach($encuesta_pregunta->pregunta->opciones as $opcion)
             <p>
               <input name="{{$encuesta_pregunta->pregunta->pregunta}}" idpregunta="{{$encuesta_pregunta->id_pregunta}}" idopcion="{{$opcion->id}}" type="radio" id="o-{{$encuesta_pregunta->pregunta->id}}-{{$opcion->opcion}}" value="{{$opcion->id}}" class="opcion"/>
               <label for="o-{{$encuesta_pregunta->pregunta->id}}-{{$opcion->opcion}}">{{$opcion->opcion}}</label>
             </p>
           @endforeach
           </form>
           </li>
         @endforeach
       </ul>
     </div>
        <a class="waves-effect waves-light btn" onclick="responder()">Responder</a>
  </div>




@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('.slider').slider({interval:80000});
  });

  var tipo = "{!! $tipo !!}";
  var id = {!! $id !!};
  var id_encuesta = {!! $encuesta->id !!}
  var id_evento = {!!  $encuesta->id_evento !!}
  var preguntas_count = {!! count($encuesta->preguntas)!!}
  var respuestas;
  function obtenerRespuestas()
  {
    respuestas = $(".opcion:checked");
    var respuestas_json = [];
    for(let i=0; i<respuestas.length; i++)
    {
      console.log(respuestas[i]);
      respuestas_json.push({id_pregunta:$(respuestas[i]).attr('idpregunta'),id_opcion:$(respuestas[i]).attr('idopcion')});
    }
    console.log(respuestas_json);
    return respuestas_json;
  }
  //TODO responder segun TIPO!
  function responder()
  {
    obtenerRespuestas();
    if(respuestas != undefined && preguntas_count <= respuestas.length)
    {
      $.ajax({
      url: '/guardarEncuestaRespuesta',
      type: 'POST',
      data: {_token: CSRF_TOKEN,
             respuestas:obtenerRespuestas(),
             tipo:tipo,
             id:id,
             id_encuesta:id_encuesta},
      dataType: 'JSON',
      success: function (data)
      {
        console.log(data);
        if(data.msg)
          Materialize.toast(data.msg, 3000, 'red rounded');
        else
        {//TODO redireccionar AQUI
          Materialize.toast('Encuesta Respondida', 3000, 'blue rounded');
          if(tipo == 'satisfaccion')
            window.location.href = "/evento/"+id_evento+"/actividad/"+id;
          else {
            window.location.href = "/califica/pendiente";
          }
        }
      }});
    }
    else
    {
      Materialize.toast('Faltan preguntas por responder!', 3000, 'red rounded');
      console.log(respuestas.length);
    }

  }
</script>
@endsection
