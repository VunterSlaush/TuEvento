<!DOCTYPE html>
<html>
  <head>
    <title>Propuesta calificada {{ $califica['idPropuesta'] }}</title>
  </head>
  <body>
    <h1>Propuesta calificada{{ $califica['idPropuesta'] }}</h1>
    <ul>
      <li>Autor: {{ $califica['cedula'] }}</li>
      <li>calificacion: {{ $califica['calificacion'] }}</li>
      <li>IdEvento: {{ $propuesta['idEvento'] }}</li>
      <li>Adjutnto: {{ $propuesta['adjunto'] }}</li>
      <li>Demanda: {{ $propuesta['demanda'] }}</li>
    </ul>

    </ul>
  </body>
</html>
