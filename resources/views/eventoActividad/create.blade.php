@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Evento: {{$nombre_evento}}</h1>
    <h2> Crear actividad</h2>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$evento->id.'/actividad'))}}

    <div class="container">
      <div class="row">
        <div class="col m6">
          {{Form::label('titulo','Titulo')}}
          {{Form::text('titulo')}}
        </div>
        <div class="col m6">
          {{Form::label('fecha','Fecha')}}
          {{Form::Date('fecha',\Carbon\Carbon::now())}}
        </div>
      </div>

      <div class="row">
        <div class="col m4">
          {{Form::label('hora_inicio','Hora de Inicio')}}
          {{Form::time('hora_inicio','20:00')}}
        </div>
        <div class="col m4">
          {{Form::label('hora_fin','Hora de Finaliz.')}}
          {{Form::time('hora_fin','20:00')}}
        </div>
        <div class="col m4">
          {{Form::label('id_user','Ponente')}}
          {{Form::text('id_user')}}
        </div>
      </div>

      <div class="row">
        <div class="col m12">
          {{Form::label('resumen','Resumen')}}
          {{Form::text('resumen')}}
        </div>
      </div>

      <div class="row">
        <div class="input-field col m6">
          <select name='area'>
            <option value="" disabled selected>Selecciona un Area</option>
            @foreach ($evento->areas as $area)
                <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
            @endforeach
          </select>
          <label>Selecciona un Area</label>
        </div>
        <div class="input-field col m6">
          <select name='tipo_actividad'>
            <option value="" disabled selected>Selecciona un Tipo de Actividad</option>
            @foreach ($evento->tipoActividad as $tipo)
                <option value="{{ $tipo->tipoActividad->nombre }}">{{ $tipo->tipoActividad->nombre }}</option>
            @endforeach
          </select>
          <label>Seleccione un Tipo de Actividad</label>
        </div>
      </div>

      {{Form::submit('Crear')}}

      {{Form::close()}}
    </div>

  </div>
@endsection

@section('scripts')
<script type="text/javascript">

  $(document).ready(function() {
    $('select').material_select();
  });
</script>
@endsection
