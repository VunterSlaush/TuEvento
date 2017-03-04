@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m6 offset-m3">
            <div class="panel panel-default">
                <div class="panel-heading"><h4> Ingreso</h4></div>
                <div class="panel-body">
                    <form class="col s12" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col m12">
                                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email">E-mail</label>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m12">
                                <input id="password" type="password" class="validate" name="password" required>
                                <label for="password">Password</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m6">
                              <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label for="remember"> Recordar </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m12 center-align">
                                <button type="submit" class="btn btn-primary">
                                    Ingreso
                                </button>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Olvidé mi contraseña
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

  $(document).ready(function()
  {
    $("#search-select").material_select();
    $.fn.select2.defaults.set('language', 'es');
  });
</script>
@endsection
