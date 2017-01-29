<!DOCTYPE html>
<html>
  <head>
    <title>Propuesta {{ $propuesta['id'] }}</title>
  </head>
  <body>
    <h1>Propuesta {{ $propuesta['id'] }}</h1>
    <ul>
      <li>Autor: {{ $propuesta['autor'] }}</li>
      <li>IdEvento: {{ $propuesta['idEvento'] }}</li>
      <li>Adjutnto: {{ $propuesta['adjunto'] }}</li>
      <li>Demanda: {{ $propuesta['demanda'] }}</li>
    </ul>
  </body>
</html>
