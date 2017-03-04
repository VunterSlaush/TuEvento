@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Evento: {{$evento->nombre}}</h1>
    <h2> Editar Actividad: {{$actividad->titulo}}</h2>

    {{Html::ul($errors->all())}}

    {{Form::model($actividad, array('route' => array('evento.actividad.update',$evento->id,$actividad->id), 'method' => 'PUT'))}}

      <div class="row">
        <div class="col m6">
          {{Form::label('titulo','Titulo')}}
          {{Form::text('titulo')}}
        </div>
        <div class="col m6">
          {{Form::label('fecha','Fecha')}}
          {{Form::Date('fecha')}}
        </div>
      </div>

      <div class="row">
        <div class="col m6">
          {{Form::label('hora_inicio','Hora de Inicio')}}
          {{Form::time('hora_inicio')}}
        </div>
        <div class="col m6">
          {{Form::label('hora_fin','Hora de Finaliz.')}}
          {{Form::time('hora_fin')}}
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
            <option value="{{$actividad->area}}" selected>{{$actividad->area->area->nombre}}</option>
            @foreach ($evento->areas as $area)
                <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
            @endforeach
          </select>
          <label>Selecciona un Area</label>
        </div>

      <div class="input-field col m6">
        <select name='tipo'>
          <option value="{{$actividad->tipo_actividad->id}}" selected>{{$actividad->tipo_actividad->nombre}}</option>
          @foreach ($evento->tipoActividad as $tipo)
              <option value="{{ $tipo->tipoActividad->id }}">{{ $tipo->tipoActividad->nombre }}</option>
          @endforeach
        </select>
        <label>Seleccione un Tipo de Actividad</label>
      </div>

    </div>
      {{Form::submit('Editar',['class' => 'waves-effect waves-light btn'])}}

      {{Form::close()}}

  </div>
@endsection

@section('scripts')
<script type="text/javascript">

  $(document).ready(function() {
    $('select').material_select();
  });
</script>
@endsection
