@extends('layouts.certs')

@section('content')
	
	<br>
	
	<center>	

	@if($certificate->imagen != '')

		<img src="/{{ $certificate->imagen }}" style="max-height: 80px; max-width: 80px;">

	@endif

		<h4>Certificado que se otorga a:</h4>		

		<br>
		
		<h1>{{ $certificate->nombre }}</h1>

		@if(property_exists($certificate,'titulo'))
			<h5>Por su valiosa asistencia y participación en <b><i>{{ $certificate->titulo }}</i></b>,<br>
			durante el evento <b><i>{{ $certificate->evento }}</i></b>,<br>llevado a cabo en {{ $certificate->lugar }} el {{$certificate->fecha }}.</h5>
		@else
			<h5>Por su valiosa asistencia y participación en el evento <b><i>{{ $certificate->evento }}</i></b>,<br> llevado a cabo en {{ $certificate->lugar }} el {{$certificate->fecha }}.</h5>
			@endif		
		
		<br>

		@if(property_exists($certificate,'ponente'))
			<p>Actividad dictada por: </p> <h5><b>{{ $certificate->ponente }}.</b></h5>
		@endif

		<br>

		@if(property_exists($certificate,'codigo'))
			<p>Código de verificación del certficado: {{$certificate->codigo}}. </p>
		@else
			<p>Código de verificación del certficado: {{$certificate->cedula}}-{{$certificate->evento_id}}.</p>
		@endif

	</center>

@endsection