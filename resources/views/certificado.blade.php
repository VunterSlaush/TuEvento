<!DOCTYPE html>
<html>
<head>	
	<title>Certificados</title>
</head>
<body>
	<h1>Certificado que se otorga a:</h1>
	<p>&nbsp;</p>
	@foreach($certificate as $cert)		
		<h4>{{ $cert->nombre }}</h4>
		
		<p>Por asistir a: {{ $cert->titulo }}</p>
		
		<p>En el evento: {{ $cert->nombre_evento }}</p>
		
		<p>Lugar y Fecha: {{ $cert->lugar }} {{ $cert->fecha }}</p>
		
	@endforeach
</body>
</html>