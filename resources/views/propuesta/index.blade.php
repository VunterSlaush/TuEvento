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

    <h1> Todas las propuestas</h1>

    @if (Session::has('message'))
      <div class="">
        {{Sesion::get('message')}}
      </div>
    @endif

    <table>
      <thead>
        <td> id </td>
        <td> autor </td>
        <td> idEvento</td>
        <td> adjunto</td>
        <td> demanda </td>
      </thead>
      <tbody>
        @foreach($propuesta as $key => $value)
        <tr>
          <td> {{$value->id}}</td>
          <td> {{$value->autor}}</td>
          <td> {{$value->idEvento}}</td>
          <td> {{$value->adjunto}}</td>
          <td> {{$value->demanda}}</td>
          <td>
            {{ Form::open(['method' => 'DELETE','route' => ['propuesta.destroy', $value->id],'style'=>'display:inline'])}}
            {{ Form::submit('Eliminar')}}
            {{ Form::close()}}
            <a href="{{route('propuesta.show',$value->id)}}"> Mostrar</a>
            <a href="{{route('propuesta.edit',$value->id)}}"> Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
