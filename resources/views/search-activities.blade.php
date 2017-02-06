@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Buscar Actividad</h1>

	{!! Form::open(['url' => 'search-activities', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
		<div class="">			
        	{!! Form::text('titulo',null, ['class' => 'form-control', 'placeholder' => 'Indique una actividad']) !!}
  		</div>
  	<button type="submit" class="btn btn-default">Buscar</button>
	{!! Form::close() !!}
</div>

<p>&nbsp;</p>

<div class="panel panel-default">    

    <table class="table table-bordered table-hover" >
        <thead>
            <th>Ponente</th>
            <th>Evento</th>
            <th>Fecha</th>
            <th>Titulo</th>
            <th>Hora</th>
        </thead>
        <tbody> 
        @foreach($actividades as $actividad)
                <tr>               
                    <td>{{ $actividad->nombre_ponente }}</td>
                    <td>{{ $actividad->nombre_evento }}</td>
                    <td>{{ $actividad->fecha }}</td>
                    <td>{{ $actividad->titulo }}</td>
                    <td>{{ $actividad->hora_inicio }}</td>
                </tr>
        @endforeach  
        </tbody>
    </table>
</div>

@endsection