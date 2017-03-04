<!DOCTYPE html>
<html lang="en">
<head>
    <title>Certificado</title>
    <link href="css/certificado.css" rel="stylesheet">
</head>
<body>
	<br />

	<center>
	
	<img src="http://vignette4.wikia.nocookie.net/batman/images/a/a7/Batman_Logo_04.png/revision/latest/scale-to-width-down/640?cb=20160614170334" style="height:150px; width:150px;">
	
	@if($certificate->imagen != '')

	<img src="http://vignette4.wikia.nocookie.net/batman/images/a/a7/Batman_Logo_04.png/revision/latest/scale-to-width-down/640?cb=20160614170334" style="height:150px; width:150px;">

	@endif

		<h3>Certificado que se otorga a:</h3>

		<br />

		<h1>{{ $certificate->nombre }}</h1>

		<br />

		@if(property_exists($certificate,'titulo'))
			<h3>Por su valiosa asistencia y participación en <br /> <i>{{ $certificate->titulo }}</i>,</h3><h4>durante el evento <b><i>{{ $certificate->evento }},</i></b></h4><h4>llevado a cabo en {{ $certificate->lugar }} el {{$certificate->fecha }}.</h4>
		@else
			<h3>Por su valiosa asistencia y participación en el evento <br /> <i>{{ $certificate->evento }}</i>,</h3>
			<h4>llevado a cabo en {{ $certificate->lugar }}, el {{$certificate->fecha }}.</h4>
		@endif

		<br>

		@if(property_exists($certificate,'ponente'))
			<p>Actividad dictada por: </p> <h3><b>{{ $certificate->ponente }}.</b></h3>
		@endif

		<br>

		@if(property_exists($certificate,'codigo'))
			<p>Código de verificación: {{$certificate->codigo}}. </p>
		@else
			<p>Código de verificación: {{$certificate->cedula}}-{{$certificate->evento_id}}.</p>
		@endif

	</center>
</body>
</html>
