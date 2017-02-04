<!DOCTYPE html>
<html>
<head>
	<title>Certificados</title>
</head>
<body>
	<h1>Certificados</h1>
	<p>&nbsp;</p>
	<table>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Cedula</th>
				<th>Fecha</th>
				<th>Titulo</th>
				<th>Evento</th>
				<th>Lugar</th>
			</tr>
		</thead>
		<tbody>
			@foreach($certified as $cert)
				<tr>
					<td>{{ $cert->nombre }}</td>
					<td>{{ $cert->cedula }}</td>
					<td>{{ $cert->fecha }}</td>
					<td>{{ $cert->titulo }}</td>
					<td>{{ $cert->nombre_evento }}</td>
					<td>{{ $cert->lugar }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>