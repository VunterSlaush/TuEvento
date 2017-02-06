<!DOCTYPE html>
<html>
<head>
  <title>Calificar</title>
</head>
<body>
  <h1>Nueva Calificacion</h1>
  <ul>
    <li> <a href="{{ URL::to('califica/pendiente')}}"> Ver Pendientes</a></li>
    <li> <a href="{{ URL::to('califica/lista')}}">Ver Calificadas</a></li>
  </ul>

  <h1>Calificar</h1>

  {{Html::ul($errors->all())}}

  {{Form::open(array('url' => 'califica'))}}

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
