@extends('layouts.app')

@section('content')
  <div class="container">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> Crear Propuesta</a>
        </div>
      </div>
    </nav>

    <h1> Crear propuesta</h1>
    <p>&nbsp;</p>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$evento->id.'/propuesta', 'files' => 'true'))}}
      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header active"><i class="material-icons">assignment</i> Información Base*</div>
          <div class="collapsible-body">
            <div class="container form-container">
              <div class="row">
                <div class="col m6">
                  {{Form::label('titulo','Titulo')}}
                  {{Form::text('titulo')}}
                </div>
                <div class="col m6">
                  {{Form::label('adjunto','Adjunto')}}
                  {{Form::File('adjunto',['style' => 'display:none'])}}
                  <br>
                  <a class="btn waves-light" href="#!" onclick="inputFileClick()">
                    <i class="material-icons left">file_upload</i>Subir
                  </a>
                </div>
              </div>
              <div class="row">
                <div class="col m12 input-field">
                  {{Form::label('descripcion','Descripcion')}}
                  {{Form::text('descripcion','',array('data-length' => '120','maxlength' => '120'))}}
                </div>
              </div>
              <div class="row">
                <div class="col m12 input-field">
                  {{Form::label('demanda','Demanda')}}
                  {{Form::textArea('demanda','',array('class' => 'materialize-textarea','data-length' => '255','maxlength' => '255'))}}
                </div>
              </div>
            </div>
          </div>
        </li>
        <li>
          <div class="collapsible-header active"><i class="material-icons">assignment</i> Información de Tipo y Area*</div>
          <div class="collapsible-body">
            <div class="container form-container">
              <div class="row">
                <div class="input-field col m6">
                  <select name='area'>
                    <option value="" disabled selected>Área</option>
                    @foreach ($evento->areas as $area)
                        <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
                    @endforeach
                  </select>
                  <label>Selecciona un Area</label>
                </div>
                <div class="input-field col m6">
                  <select name='tipo'>
                    <option value="" disabled selected>Actividad</option>
                    @foreach ($evento->tipoActividad as $tipo)
                        <option value="{{ $tipo->tipoActividad->nombre }}">{{ $tipo->tipoActividad->nombre }}</option>
                    @endforeach
                  </select>
                  <label>Seleccione un Tipo de Actividad</label>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <center>{{Form::submit('Crear', ['class' => 'waves-effect waves-light btn'])}}</center>
      {{Form::close()}}
    </div>

  </div>
@endsection

@section('scripts')
<script type="text/javascript">

  $(document).ready(function() {
    $('select').material_select();
  });

  function inputFileClick() {
    $("input[name='adjunto']").click();
  }
</script>
@endsection
