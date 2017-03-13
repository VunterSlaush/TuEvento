@extends('layouts.app')

@section('content')
  <div class="container">
    <h3> Seleccionar encuesta para {{$propuesta->titulo}}</h3>
    <div class="input-field col s12">
    <select id='select_encuesta'>
      <option value="" disabled selected>Choose your option</option>
      @foreach($encuestas as $encuesta)
      <option value="{{$encuesta->id}}">{{$encuesta->nombre}}</option>
      @endforeach
    </select>
  </div>
  <a class="waves-effect waves-light btn" onclick="encuestar()"><i class="material-icons right">send</i>Seleccionar</a>
  </div>
  @endsection
  @section('scripts')
  <script type="text/javascript">
    var id_propuesta = {{$propuesta->id}};
    $(document).ready(function() {
      $('select').material_select();
    });

    function encuestar()
    {
        var id_encuesta = $('#select_encuesta').val();
        console.log('encuesta_pa ve:'+id_encuesta);
        var ruta = '/propuesta/'+id_propuesta+'/evaluar/'+id_encuesta;
        window.location.href = ruta;
    }
  </script>
  @endsection
