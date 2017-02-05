<!DOCTYPE html>
<html>
<head>
<title>Calificaciones Index</title>
</head>
<body>
  <h1>Editar Calificacion</h1>
  <ul>
    <li> <a href="{{ URL::to('califica/pendiente')}}"> Ver Pendientes</a></li>
    <li> <a href="{{ URL::to('califica/lista')}}">Ver Calificadas</a></li>
  </ul>

  <h1>Calificar</h1>

  {{Html::ul($errors->all())}}

  {{Form::model($califica, array('route' => array('califica.update', $califica->idPropuesta), 'method' => 'PUT'))}}

  <div class="">
    <div class="">
      {{Form::label('cedula','cedula')}}
      {{Form::text('cedula')}}
    </div>
    <div class="">
      {{Form::label('idPropuesta','idPropuesta')}}
      {{Form::text('idPropuesta')}}
    </div>
    <div class="">
      {{Form::label('calificacion','calificacion')}}
      {{Form::text('calificacion')}}
    </div>
    {{Form::submit('Calificar')}}

    {{Form::close()}}
  </div>

</body>
</html>
