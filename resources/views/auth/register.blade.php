@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m6 offset-m3">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Registro</h4></div>
                <div class="panel-body">
                    <form class="col s12" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col m6">
                                <label for="nombre">Nombre</label>
                                <input class="validate" placeholder="Ingrese su nombre" id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col m6">
                                <label for="cedula">Cedula</label>
                                <input class="validate" placeholder="Ingrese su Cedula" id="cedula" type="number" class="form-control" name="cedula" value="{{ old('cedula') }}" required autofocus>
                                @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m12">
                                <label for="email">Correo Electrónico</label>
                                <input class="validate" placeholder="Ingrese su correp" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m12">
                                <label for="organizacion">Organizacion (Opcional)</label>
                                <input class="validate" placeholder="Organizacion" id="organizacion" type="text" class="form-control" name="organizacion" value="{{ old('organizacion') }}">
                                @if ($errors->has('organizacion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organizacion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m6">
                                <label for="password">Contraseña</label>
                                <input class="validate" placeholder="Contraseña" id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col m6">
                                <label for="password-confirm">Confirmar Contraseña</label>
                                <input class="validate" placeholder="Confirmar Contraseña"id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col m6 offset-m4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
