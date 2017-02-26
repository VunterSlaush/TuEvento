@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Jurado:</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$evento->id.'/jurado'))}}

    <div class="row">
      <div class="col m6">
        <label for="id_user"> Usuario</label>
        <select name='id_user' class="user-select">
          <option value="" disabled selected>Selecciona un Usuario</option>
          @foreach ($usuarios as $user)
            <option value="{{$user->cedula}}"> {{$user->nombre}} </option>
          @endforeach
        </select>
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

  });
</script>
@endsection
