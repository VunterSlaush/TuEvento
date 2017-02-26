@extends('layouts.app')

@section('content')
  <div class="container">

    <h1> Crear propuesta</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$evento->id.'/propuesta', 'files' => 'true'))}}

      <div class="row">
        <div class="col m6">
          {{Form::label('titulo','Titulo')}}
          {{Form::text('titulo')}}
        </div>
        <div class="col m6">
          {{Form::label('duracion','Duracion')}}
          {{Form::text('duracion')}}
        </div>
      </div>
      <div class="row">
        <div class="col m6">
          {{Form::label('descripcion','Descripcion')}}
          {{Form::text('descripcion')}}
        </div>
        <div class="col m6">
          {{Form::label('adjunto','Adjunto')}}
          {{Form::File('adjunto')}}
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
          <select name='tipo'>
            <option value="" disabled selected>Selecciona un Tipo de Actividad</option>
            @foreach ($evento->tipoActividad as $tipo)
                <option value="{{ $tipo->tipoActividad->nombre }}">{{ $tipo->tipoActividad->nombre }}</option>
            @endforeach
          </select>
          <label>Seleccione un Tipo de Actividad</label>
        </div>
      </div>

      <div class="col m12">
        {{Form::label('demanda','Demanda')}}
        {{Form::text('demanda')}}
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
