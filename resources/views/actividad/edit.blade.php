<!DOCTYPE html>
<html>
  <head>
    <title>Actividades Index</title>
  </head>
  <body>
    <h1>Actividades Index</h1>
    <ul>
      <li> <a href="{{ URL::to('actividad')}}"> Ver todos</a></li>
      <li> <a href="{{ URL::to('actividad/create')}}"> Crear</a></li>
    </ul>

    <h1> Crear actividad</h1>

    {{Html::ul($errors->all())}}

  {{Form::model($actividad, array('route' => array('actividad.update', $actividad->id), 'method' => 'PUT'))}}

    <div class="">
      <div class="">
        {{Form::label('idEvento','IdEvento')}}
        {{Form::text('idEvento')}}
      </div>
      <div class="">
        {{Form::label('titulo','Titulo')}}
        {{Form::File('titulo')}}
      </div>
      <div class="">
        {{Form::label('adjunto','Adjunto')}}
        {{Form::File('adjunto')}}
      </div>
      <div class="">
        {{Form::label('demanda','Demanda')}}
        {{Form::text('demanda')}}
      </div>
      {{Form::submit('Editar')}}

      {{Form::close()}}
    </div>

  </body>
</html>
