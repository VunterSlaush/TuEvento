@extends('layouts.app')

@section('content')
  <div class="container">
    <nav id="breadcrumb-nav">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="#" class="breadcrumb"> {{$evento->nombre}}</a>
        </div>
      </div>
    </nav>

    {{ Form::open(['method' => 'POST','route' => ['actividad.createFromProp',$evento->id],'style' => 'display:none']) }}
    {{ Form::submit('Aprobar')}}
    {{ Form::close()}}

    <ul>
      <li class="collection-header"> <h4> {{$evento['nombre']}}</h4> </li>
      <li class="collection-item">
        <ul>
          <li> <strong>Creador:</strong> {{$evento['user']->nombre}}</li>
          <li> <strong>Lugar:</strong> {{ $evento['lugar'] }}</li>
          <li> <strong>Fecha de Inicio:</strong> {{ $evento['fecha_inicio'] }}</li>
          <li> <strong>Fecha de Finalización:</strong> {{ $evento['fecha_fin'] }}</li>
          <li> <strong>Estado:</strong> {{ $evento['estado'] }}</li>
          <li>
            <strong>Áreas:</strong>
            @foreach ($evento->areas as $area)
                {{ $area->area->nombre }}
            @endforeach
          </li>
          <li>
            <strong>Tipo de Actividades:</strong>
            @foreach ($evento->tipoActividad as $tipo)
                {{ $tipo->tipoActividad->nombre }}
            @endforeach
          </li>
        </ul>
      </li>

      <li class="collection-item">
        <ul>
          <li> <strong>Comité:</strong></li>
          <ul>
          @foreach ($evento->comites as $comite)
              <li>{{ $comite->user->nombre }}</li>
          @endforeach
          </ul>
          <li> <strong>Jurado:</strong></li>
          <ul>
          @foreach ($evento->jurados as $jurado)
              <li>{{ $jurado->user->nombre }}
                  (
                  @foreach ($jurado->areas as $area)
                    {{ $area->area->nombre }},
                  @endforeach
                  )
              </li>
          @endforeach
          </ul>
        </ul>
      </li>
      <li class="collection-item">
        <p>Actividades</p>
        <a class="btn" href="{{ route('evento.actividad.index',$evento->id)}}">Ver actividades</a>
        @can ('modify',$evento)
          @can ('viewState',[$evento,['inscripciones','iniciado']])
          <a class="btn" href="{{ route('evento.actividad.create',$evento->id)}}">Crear actividades</a>
          @endcan
          @can ('viewState',[$evento,['inscripciones']])
          <a class="btn" href="{{ route('evento.organizar',$evento->id) }}">Ordenar Actividades</a>
          @endcan
        @endcan
      </li>
      <li class="collection-item">
        <p>Propuestas</p>
        <a class="btn" href="{{ route('evento.propuesta.index',$evento->id)}}">Ver propuestas</a>
        @can ('viewState',[$evento,['inscripciones']])
          <a class="btn" href="{{ route('evento.propuesta.create',$evento->id)}}">Enviar Propuesta</a>
        @endcan
      </li>

      @can ('viewState',[$evento,['inscripciones']])
        <li class="collection-item">
          <p>Organización</p>
          @can ('modify',$evento)
            <a class="btn" href="{{ route('evento.comite.create',$evento->id) }}">Asignar Comité</a>
            <a class="btn" href="{{ route('evento.jurado.create',$evento->id) }}">Asignar Jurado</a>
          @endcan
        </li>
      @endcan

      @can ('modify',$evento)
        @can ('viewState',[$evento,['inscripciones','iniciado']])
      <li class="collection-item">
        <p>Encuestas y Preguntas</p>
          <a class="btn" href="{{ route('createPregunta',$evento->id) }}">Crear Pregunta</a>
          <a class="btn" href="{{ route('createEncuesta',$evento->id) }}">Crear Encuesta</a>
      </li>
        @endcan
      @endcan


      @can ('modify',$evento)
        <li class="collection-item">
          <h4> Control de estados</h4>
            
            <input class="with-gap" type="radio" name="estado" id="estado-ins" value="inscripciones" >
            <label for="estado-ins"> Inscripciones</label>

            <input class="with-gap" type="radio" name="estado" id="estado-ini" value="iniciado">
            <label for="estado-ini"> Iniciado</label>
            
            <input class="with-gap" type="radio" name="estado" id="estado-fin" value="finalizado">
            <label for="estado-fin"> Finalizado</label>
        </li>
      @endcan
      </li>
    </ul>

    <div class="modal modal-fixed-footer">
      <div class="modal-content">
        <div class="content-m content-ins" style="display:none">
          <h4> Inscripciones Evento</h4>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>

        <div class="content-m content-ini" style="display:none">
          <h4> Iniciar Evento</h4>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>

        <div class="content-m content-fin" style="display:none">
          <h4> finalizar Evento</h4>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
      <div class="modal-footer">
        <a id="aceptar"href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"> Aceptar</a>
        <a id="cancelar"href="#!" class="modal-action modal-close waves-effect waves-red btn-flat"> Cancelar</a>
      </div>
    </div>

  </div>

@endsection

@section('scripts')
<script type="text/javascript">
  evento = {!!$evento!!};

  $(document).ready(function() {
    active_input = $("input[value='"+ evento.estado +"']");
    active_input.prop("checked","true");
    active_input.prop("disabled","true");
    $(".modal").modal();
  });

  $("input[name='estado']").click(function(e) {
      e.preventDefault();
      state_input = $(this);

      $('.modal').modal('open');

      $('.content-m').each(function() {
        $(this).css("display","none");
      })
      state = $(this).prop('value');
      switch (state) {
        case "inscripciones":
          $(".content-ins").css("display","block");
          break;
        case "iniciado":
          $(".content-ini").css("display","block");
          break;
        case "finalizado":
          $(".content-fin").css("display","block");
          break;
      }
  });

  $(".modal-action").click(function(e) {
    if ($(this).prop("id") == "aceptar"){

      var data_out = JSON.stringify({
        id : evento.id,
        estado : state
      });

      actualizarEstadoEvento(data_out,state_input);
    }
  });

  function actualizarEstadoEvento(data_out, state_input) {
    $.ajax({
      url: '/stateUpdate',
      type: 'POST',
      data: {_token:CSRF_TOKEN,evento:data_out},
      dataType: 'JSON',
      success: function (data)
      {
          console.log(data.success);
          if(data.success == 'true'){
            $("input[name='estado']:checked").prop("checked","false");
            $("input[name='estado']:checked").removeAttr("disabled");
            state_input.prop("checked","true");
            state_input.prop("disabled","true");
            location.reload();
          }
          else{
            Materialize.toast("Error al actualizar evento",2000);
          }
      }
    });
  }




</script>
@endsection
