<!DOCTYPE html>
<html>
<head>
  <title>Califica Index</title>
</head>
<body>
  <h1>Califica Index</h1>
  <ul>
    <li> <a href="{{ URL::to('califica/pendiente')}}"> Ver Pendientes</a></li>
    <li> <a href="{{ URL::to('califica/lista')}}">Ver Calificadas</a></li>
  </ul>

  @if (Session::has('success'))
  <div class="">
    {{Session::get('success')}}
  </div>
  @endif  

</body>
</html>
