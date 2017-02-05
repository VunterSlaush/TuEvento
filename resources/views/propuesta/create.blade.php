<!DOCTYPE html>
<html>
<head>
  <title>Propuestas Index</title>
</head>
<body>
  <h1>Propuestas Index</h1>
  <ul>
    <li> <a href="{{ URL::to('propuesta')}}"> Ver todos</a></li>
    <li> <a href="{{ URL::to('propuesta/create')}}"> Crear</a></li>
  </ul>

  <h1> Crear propuesta</h1>

  {{Html::ul($errors->all())}}

  {{Form::open(array('url' => 'propuesta'))}}

  <div class="">
      <div class="">
        {{Form::label('autor','autor')}}
        {{Form::text('autor')}}
      </div>
      <div class="">
        {{Form::label('idEvento','IdEvento')}}
        {{Form::text('idEvento')}}
      </div>
      <div class="">
        {{Form::label('titulo','titulo')}}
        {{Form::text('titulo')}}
      </div>
      
      <div class="">
        {{Form::label('adjunto','Adjunto')}}
        {{Form::File('adjunto')}}
      </div>
      <div class="">
        {{Form::label('demanda','Demanda')}}
        {{Form::text('demanda')}}
      </div>
      <div class="">
        {{Form::label('descripcion','descripcion')}}
        {{Form::text('descripcion')}}
      </div>
      <div class="">
        {{Form::label('duracion','duracion')}}
        {{Form::text('duracion')}}
      </div>
    {{Form::submit('Crear')}}

    {{Form::close()}}
  </div>

</body>
</html>
