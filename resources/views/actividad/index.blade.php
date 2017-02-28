@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Todas las actividades</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <th> Ponente </th>
        <th> Evento</th>
        <th> Fecha</th>
        <th> Titulo </th>
        <th> Inicio </th>
        <th> Fin </th>
        <th> Resumen </th>
        <th> Acciones </th>
      </thead>
      <tbody>
        @foreach($actividad as $key => $value)
        <tr>
          <td> {{$value->user->nombre}}</td>
          <td> {{$value->evento->nombre}}</td>
          <td> {{$value->fecha}}</td>
          <td> {{$value->titulo}}</td>
          <td> {{$value->hora_inicio}}</td>
          <td> {{$value->hora_fin}}</td>
          <td> {{$value->resumen}}</td>
          <td class="action">
            <a class='dropdown-button btn' href='#'>Acciones</a>

            <!-- Dropdown Structure -->
            <ul class='dropdown-content'>
              <li><a href="/actividad/{{$value->id}}/asistir"> Asistir</a></li>
              <li><a href="{{route('actividad.show',$value->id)}}"> Mostrar</a></li>
              @can('modify',$value)
                <li><a href="{{route('actividad.edit',$value->id)}}"> Editar</a></li>
                <li><a href="deleteActivity({{ $value->id }});" data-method="delete">Eliminar</a></li>
              @endcan
            </ul>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
<script type="text/javascript">
$(".action").each(function(i) {
  $(this).find("a.dropdown-button").attr('data-activates','dropdown_'+ i);
  $(this).find("ul.dropdown-content").attr('id','dropdown_' +i );
});

  function deleteActivity(id)
  {
    if (confirm('Borrar esta Actividad?')) {
        $.ajax({
            type: "DELETE",
            data: {_token: CSRF_TOKEN},
            url: '/actividad/' + id, //resource
            success: function(affectedRows) {
                console.log(affectedRows);
                location.reload(true);
            }
        });
    }
  }
</script>
@endsection
