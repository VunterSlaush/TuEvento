@extends('layouts.app')

@section('content')
  <div class="container">
    <nav id="breadcrumb-nav">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="/evento/{{$evento->id}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb">Propuestas Aprobadas</a>
        </div>
      </div>
    </nav>
    <h3> Propuestas Aprobadas</h3>
    <a class="waves-effect waves-light btn" onclick="aprobarSeleccionados()">Aprobar Seleccionados</a>
    <a class="waves-effect waves-light btn" onclick="reprobarSeleccionados()">Reprobar Seleccionados</a>

    <table id="event_table">
      <thead>
        <tr>
          <th> Autor </th>
          <th> Titulo </th>
          <th> Tipo </th>
          <th> Seleccion </th>
          <th> Acciones </th>
        </tr>
      </thead>

      <tbody>
        @foreach($aprobados as $key => $value)
        <tr id='{{$value->id}}'>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->tipo->nombre}}</td>
          <td>
            <p style="margin-left:25px;">
              <input type="checkbox" class="filled-in" id="ap{{$value->id}}" checked="checked" idpropuesta ="{{$value->id}}"/>
              <label for="ap{{$value->id}}"></label>
            </p>
          </td>
          <td class="action">
            <a class='btn' href='/evento/{{$evento->id}}/propuesta/{{$value->id}}'><i class="material-icons">visibility</i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')

  <script type="text/javascript">
  var id_evento = {!! $evento->id !!};
    function generarSeleccionados()
    {
      var checkeds  = $('.filled-in:checked');
      var seleccionados = [];
      for (var i = 0; i < checkeds.length; i++) {
        seleccionados.push($(checkeds[i]).attr('idpropuesta'));
      }
      return seleccionados;
    }

    function aprobarSeleccionados()
    {
      var selec = generarSeleccionados();
      if(selec.length > 0)
      {
        $.ajax({
        url: '/evento/aprobar',
        type: 'POST',
        data: {_token: CSRF_TOKEN, ids:selec, id_evento:id_evento},
        dataType: 'JSON',
        success: function (data)
        {
          console.log(data);
          if(data.msg)
            Materialize.toast(data.msg, 3000, 'red rounded');
          else
          {
            location.reload();
          }
        }});
      }
      else
      {
          Materialize.toast('no hay propuestas Seleccionadas', 3000, 'red rounded');
      }
      console.log(selec);
    }

    function reprobarSeleccionados()
    {
      var selec = generarSeleccionados();
      if(selec.length > 0)
      {
        $.ajax({
        url: '/evento/reprobar',
        type: 'POST',
        data: {_token: CSRF_TOKEN, ids:selec, id_evento:id_evento},
        dataType: 'JSON',
        success: function (data)
        {
          console.log(data);
          if(data.msg)
            Materialize.toast(data.msg, 3000, 'red rounded');
          else
          {
            location.reload();
          }
        }});
      }
      else
      {
          Materialize.toast('no hay propuestas Seleccionadas', 3000, 'red rounded');
      }
      console.log(selec);
    }
  </script>
@endsection
