@extends('layouts.app')

@section('content')
  <div class="container">
    <nav id="breadcrumb-nav">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="#" class="breadcrumb"> Mis Actividades</a>
        </div>
      </div>
    </nav>
    <h1>Mi perfil</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="col m1"><i class="medium material-icons" style="color:#1565c0;">perm_identity</i></div>
      <div class="col m6">
          <div class="col m10">
            <div class="input-field">
              <input id="nombre" type="text" required value="{{$user->nombre}}">
                @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
              <label>Nuevo nombre</label>
            </div>
          </div>
          <div class="col m2">
            <a id='name_button' class="btn btn-floating waves-effect waves-light"><i class="material-icons">edit</i></a>
            <div id='name_loaded' class="preloader-wrapper small">
              <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col m1"><i class="medium material-icons" style="color:#1565c0;">mail</i></div>
      <div class="col m6">
        <div class="col m10">
          <div class="input-field">
            <input id="email" type="text" class="validate" value="{{$user->email}}">
            <label>Nuevo e-mail</label>
          </div>
        </div>
        <div class="col m2">
          <a  id='email_button' class="btn btn-floating waves-effect waves-light"><i class="material-icons">edit</i></a>
          <div id='email_loaded' class="preloader-wrapper small">
            <div class="spinner-layer spinner-blue-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col m1"><i class="medium material-icons" style="color:#1565c0;">lock</i></div>
      <div class="col m10">
        <div class="col m4">
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
          <div class="input-field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="confirm_pass" type="password" class="validate" required>
              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            <label>Confirmar contraseña</label>
          </div>
        </div>
        <div class="col m3">
          <a id='password_button' class="btn btn-floating waves-effect waves-light"><i class="material-icons">edit</i></a>
          <div id='password_loaded' class="preloader-wrapper small">
            <div class="spinner-layer spinner-blue-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col m1"><i class="medium material-icons" style="color:#1565c0;">group_work</i></div>
      <div class="col m6">
        <div class="col m10">
          <div class="input-field form-group{{ $errors->has('organizacion') ? ' has-error' : '' }}">
            <input id="organizacion" type="text" class="validate" required value="{{$user->organizacion}}">
              @if ($errors->has('organizacion'))
                <span class="help-block">
                  <strong>{{ $errors->first('organizacion') }}</strong>
                </span>
              @endif
            <label>Nueva organización</label>
          </div>
        </div>
        <div class="col m2">
            <a id='organization_button' class="btn btn-floating waves-effect waves-light"><i class="material-icons">edit</i></a>
            <div id='organization_loaded' class="preloader-wrapper small">
              <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')

  <script type="text/javascript">
    var user_id = {!! $user->cedula !!};

    $('#name_button').on('click',function () {
      $('#name_loaded').addClass('active');
      $(this).hide();
      updateData($(this),$('#name_loaded'));
    });

    $('#email_button').on('click',function () {
      $('#email_loaded').addClass('active');
      $(this).hide();
      updateData($(this),$('#email_loaded'));
    });

    $('#password_button').on('click',function () {
      $('#password_loaded').addClass('active');
      $(this).hide();
      updateData($(this),$('#password_loaded'));
    });

    $('#organization_button').on('click',function () {
      $('#organization_loaded').addClass('active');
      $(this).hide();
      updateData($(this),$('#organization_loaded'));
    });

    function updateData(button,loaded)
    {
      $.ajax({
      url: '/updateProfile',
      type: 'POST',
      data: {_token: CSRF_TOKEN, cedula:user_id,
                                 nombre:$('#nombre').val(),
                                 email:$('#email').val(),
                                 pass:$('#password').val(),
                                 confirm_pass:$('#confirm_pass').val(),
                                 organization:$('#organizacion').val()},
      dataType: 'JSON',
      success: function (data)
      {
        translateJsonResult(data);
        button.show();
        loaded.removeClass('active');
      },
      error: function()
      {
         button.show();
         loaded.removeClass('active');
      }
      });
    }

    function translateJsonResult(data)
    {
      var mod = 0;
      if(data.pass.modify)
      {
        Materialize.toast('Contraseña modificada satisfactoriamente', 3000, 'blue rounded');
        mod++;
      }
      else if(!data.pass.succes)
      {
        Materialize.toast(data.pass.msg, 3000, 'red rounded');
        mod++;
      }

      if(data.org.modify)
      {
        Materialize.toast('Organizacion modificada satisfactoriamente', 3000, 'blue rounded');
        mod++;
      }

      if(data.name.modify)
      {
        Materialize.toast('Nombre modificado satisfactoriamente', 3000, 'blue rounded');
        $('#user_name_horizontal').text(data.user.nombre);
        mod++;
      }

      if(data.email.modify)
      {
        Materialize.toast('Correo modificado satisfactoriamente', 3000, 'blue rounded');
        mod++;
      }

      if(mod == 0)
      {
        Materialize.toast('No hubo ninguna modificacion', 3000, 'blue rounded');
      }
    }
  </script>
@endsection
