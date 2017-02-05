<!DOCTYPE html>
<html>
<head>
  <title>Calificadas</title>
</head>
<body>
  <h1>Calificadas</h1>
  <ul>
    <li> <a href="{{ URL::to('califica')}}"> Volver</a></li>
  </ul>

  <h1> Propuestas calificadas por Usted</h1>

  @if (Session::has('success'))
  <div class="">
    {{Session::get('success')}}
  </div>
  @endif  

  <table>
    <thead>
      <td> cedula calificador </td>
      <td> idPropuesta </td>
      <td> calificacion </td>
      <td> autor </td>
      <td> idEvento</td>
      <td> adjunto</td>
      <td> demanda </td>
    </thead>
    <tbody>
      @foreach($califica as $key => $value)
      <tr>
        <td> {{$value->cedula}}</td>
        <td> {{$value->idPropuesta}}</td>
        <td> {{$value->calificacion}}</td>
        <td> {{$propuestas[$key]->autor}}</td>
        <td> {{$propuestas[$key]->idEvento}}</td>
        <td> {{$propuestas[$key]->adjunto}}</td>
        <td> {{$propuestas[$key]->demanda}}</td>
        
        <td>
          {{ Form::open(['method' => 'DELETE','route' => ['califica.destroy', $value->id],'style'=>'display:inline'])}}
          {{ Form::submit('Eliminar')}}
          {{ Form::close()}}
          <a href="{{route('califica.show',$value->id)}}"> Ver detalles</a>
          <a href="{{route('califica.edit',$value->id)}}"> Editar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


</body>
</html>
