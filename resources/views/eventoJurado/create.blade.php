@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Jurado:</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$evento->id.'/jurado'))}}

    <div class="row">
      <div class="col m6">
        {{Form::label('Ingrese la Cedula','Usuario id')}}
        {{Form::text('id_user')}}
      </div>
      <div class="input-field col m6">
        <select name='area'>
          <option value="" disabled selected>Selecciona un Area</option>
          @foreach ($evento->areas as $area)
              <option value="{{ $area->area->nombre }}">{{ $area->area->nombre }}</option>
          @endforeach
        </select>
        <label>Selecciona un Area</label>
      </div>
    </div>
    <div class="row">
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
