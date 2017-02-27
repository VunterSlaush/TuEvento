@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Mi perfil</h1>
    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif
  </div>
<form role="form" method="POST" action="{{ url('/miPerfil') }}">
  <div class="container">  
    <p>Cambiar Nombre</p>
    <div class="row">
      <div class="col m12">
        <div class="col m1"><i class="material-icons" style="color:#1565c0;">perm_identity</i></div>
        <div class="col m6">
          <div class="input-field form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">            
            <input id="nombre" type="text" class="validate" required>
              @if ($errors->has('nombre'))
                  <span class="help-block">
                      <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
              @endif
            <label>Nuevo nombre</label>
          </div>
        </div>
        <div class="col m4">
          <button type="submit" class="waves-effect waves-light btn">Cambiar</button>  
        </div>
      </div>
    </div>
  </div>
</form>
<form role="form" method="POST" action="{{ url('/miPerfil') }}">
  <div class="container">
    <p>Cambiar Contraseña</p>
    <div class="row">
      <div class="col m12">
        <div class="col m1"><i class="material-icons" style="color:#1565c0;">lock</i></div>
        <div class="col m6">
          <div class="input-field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="validate" required>
              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            <label>Nueva contraseña</label>
          </div>
        </div>
        <div class="col m4">
          <button type="submit" class="waves-effect waves-light btn">Cambiar</button>  
        </div>
      </div>
    </div>
  </div>
</form>
<form role="form" method="POST" action="{{ url('/index') }}">
  <div class="container">
    <p>Cambiar E-Mail</p>
    <div class="row">
      <div class="col m12">
        <div class="col m1"><i class="material-icons" style="color:#1565c0;">email</i></div>
        <div class="col m6">
          <div class="input-field form-group{{ $errors->has('email') ? ' has-error' : '' }}">            
            <input id="email" type="text" class="validate" required>
              @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            <label>Nuevo e-mail</label>
          </div>
        </div>
        <div class="col m4">
          <button type="submit" class="waves-effect waves-light btn">Cambiar</button>  
        </div>
      </div>
    </div>
  </div>
</form>
<form role="form" method="POST" action="{{ url('/index') }}">
  <div class="container">
    <p>Cambiar Organización</p>
    <div class="row">
      <div class="col m12">
        <div class="col m1"><i class="material-icons" style="color:#1565c0;">group_work</i></div>
        <div class="col m6">
          <div class="input-field form-group{{ $errors->has('organizacion') ? ' has-error' : '' }}">            
            <input id="organizacion" type="text" class="validate" required>
              @if ($errors->has('organizacion'))
                <span class="help-block">
                  <strong>{{ $errors->first('organizacion') }}</strong>
                </span>
              @endif
            <label>Nueva organización</label>
          </div>
        </div>
        <div class="col m4">
          <button type="submit" class="waves-effect waves-light btn">Cambiar</button>  
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
