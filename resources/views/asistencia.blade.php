<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="css/asistencia.css" rel="stylesheet">
</head>
<body>
<div>    
<center>
    <h4>&nbsp;</h4>
    <h3>Planilla de Asistencia</h3>
    <h3>{{$title->titulo}}</h3>
    <br>
    <table>
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Cedula</th>
        <th>Email</th>
        <th>Asistencia</th>
      </tr>
      </thead>
      <br>
      <tbody>
        @foreach($asistencia as $value)
        <tr>
          <td>{{$value->nombre}}</td>
          <td>{{$value->cedula}}</td>
          <td>{{$value->email}}</td>          
          @if (($value->asistio) === true) 
            <td>Asistio</td>
          @else <td>No asistio</td>
          @endif          
        </tr>
        @endforeach
      </tbody>
    </table>
  </center>
  </div>
</body>
</html>
