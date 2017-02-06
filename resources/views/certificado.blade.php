<!DOCTYPE html>
<html>
<head>
	<title>Certificado</title>
</head>
<body>
	<h1>Certificado que se otorga a:</h1>
	<p>&nbsp;</p>

		<h4>{{ $certificate->nombre }}</h4>

		<p>Por asistir a: {{ $certificate->titulo }}</p>

		<p>En el evento: {{ $certificate->evento }}</p>

		<p>Por el Ponente: {{ $certificate->ponente }}</p>

		<p>Lugar y Fecha: {{ $certificate->lugar }} {{ $certificate->fecha }}</p>
		<p>Codigo Para verificar la validez de este certficado: {{$certificate->codigo}} </p>

</body>
</html>
