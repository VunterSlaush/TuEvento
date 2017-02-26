<!DOCTYPE html>
<html>
<head>
	<title>Certificado</title>
</head>
<body>
	<h1>Certificado que se otorga a:</h1>
	<p>&nbsp;</p>

		<h4>{{ $certificate->nombre }}</h4>

		@if(property_exists($certificate,'titulo'))
		<p>Por asistir a: {{ $certificate->titulo }}</p>
		@endif
		<p>En el evento: {{ $certificate->evento }}</p>

		@if(property_exists($certificate,'ponente'))
				<p>Por el Ponente: {{ $certificate->ponente }}</p>
		@endif


		<p>Lugar y Fecha: {{ $certificate->lugar }} {{ $certificate->fecha }}</p>
		@if(property_exists($certificate,'codigo'))
		<p>Codigo Para verificar la validez de este certficado: {{$certificate->codigo}} </p>
		@else
		<p>Codigo Para verificar la validez de este certficado: {{$certificate->cedula}}-{{$certificate->evento_id}} </p>
		@endif
</body>
</html>
