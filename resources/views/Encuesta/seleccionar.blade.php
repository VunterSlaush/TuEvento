@extends('layouts.app')

@section('content')

<div class="content-head col s12">
  <nav id="breadcrumb-nav" class="hide-on-med-and-down">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="/home" class="breadcrumb"> Dashboard</a>
        <a href="/califica/pendiente" class="breadcrumb"> Propuestas por Calificar</a>
        <a href="#" class="breadcrumb">Evaluar</a>
      </div>
    </div>
  </nav>
  <div class="container">
    <h3> Evaluar Propuesta</h3>
  </div>
</div>

<div class="content-body">
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
</div>

  <div class="container">
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
        if(id_encuesta != null)
        {
          console.log('encuesta_pa ve:'+id_encuesta);
          var ruta = '/propuesta/'+id_propuesta+'/evaluar/'+id_encuesta;
          window.location.href = ruta;
        }
        else
        {
          Materialize.toast('Seleccione una Encuesta', 3000, 'red rounded');
        }
    }
  </script>
  @endsection
