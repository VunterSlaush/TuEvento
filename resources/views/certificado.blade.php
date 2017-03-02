<!DOCTYPE html>
<html lang="en">
<head>
    <title>Certificado</title>
    <link href="css/certificado.css" rel="stylesheet">
</head>
<body background-image="img/back-certs.jpg">
	<br>

	<center>

	@if($certificate->imagen != '')

	<img src="http://vignette4.wikia.nocookie.net/batman/images/a/a7/Batman_Logo_04.png/revision/latest/scale-to-width-down/640?cb=20160614170334" style="height:150px; width:150px;">

	@endif

		<h3>Certificado que se otorga a:</h3>

		<br>

		<h1>{{ $certificate->nombre }}</h1>

		@if(property_exists($certificate,'titulo'))
			<h3>Por su valiosa asistencia y participación en <b><i>{{ $certificate->titulo }}</i></b>,<br>
			durante el evento <b><i>{{ $certificate->evento }}</i></b>,<br>llevado a cabo en {{ $certificate->lugar }} el {{$certificate->fecha }}.</h3>
		@else
			<h3>Por su valiosa asistencia y participación en el evento <b><i>{{ $certificate->evento }}</i></b>,<br> llevado a cabo en {{ $certificate->lugar }} el {{$certificate->fecha }}.</h3>
			@endif

		<br>

		@if(property_exists($certificate,'ponente'))
			<p>Actividad dictada por: </p> <h3><b>{{ $certificate->ponente }}.</b></h3>
		@endif

		<br>

		@if(property_exists($certificate,'codigo'))
			<p>Código de verificación del certficado: {{$certificate->codigo}}. </p>
		@else
			<p>Código de verificación del certficado: {{$certificate->cedula}}-{{$certificate->evento_id}}.</p>
		@endif

	</center>
</body>
</html>
