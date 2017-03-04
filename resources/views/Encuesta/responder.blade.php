@extends('layouts.app')

@section('content')
  <div class="container">
    <h3>{{$encuesta->nombre}}</h3>
    @foreach($encuesta->preguntas as $encuesta_pregunta)
      <h4>{{$encuesta_pregunta->pregunta->pregunta}}</h4>
      <form action="#" id="p{{$encuesta_pregunta->pregunta->id}}">
      @foreach($encuesta_pregunta->pregunta->opciones as $opcion)
        <p>
          <input name="{{$encuesta_pregunta->pregunta->pregunta}}" type="radio" id="o{{$opcion->opcion}}" value="{{$opcion->id}}"/>
          <label for="o{{$opcion->opcion}}">{{$opcion->opcion}}</label>
        </p>
      @endforeach
      </form>
    @endforeach
    <a class="waves-effect waves-light btn" onclick="responder()">Responder</a>
  </div>


@endsection

@section('scripts')
<script type="text/javascript">
  function responder()
  {
    var respuesta = $("input[type='radio']:checked").val();
    console.log(respuesta);
  }
</script>
@endsection
