@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Asignar Comite:</h1>

    {{Html::ul($errors->all())}}

    {{Form::open(array('url' => 'evento/'.$id_evento.'/comite'))}}

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
      {{Form::submit('Crear')}}
      {{Form::close()}}
    </div>

  </div>
@endsection
