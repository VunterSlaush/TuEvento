@extends('layouts.app')

@section('content')
  <div class="container">
              {{ Form::open(['method' => 'POST','route' => ['actividad.createFromProp',$evento->id],'style' => 'display:none']) }}
              {{ Form::submit('Aprobar')}}
              {{ Form::close()}}

    <ul>
      <li class="collection-header"> <h4> {{$evento['nombre']}}</h4> </li>
      <li class="collection-item">
        <ul>
          <li> <strong>Creador:</strong> {{$evento['user']->nombre}}</li>
          <li> <strong>Lugar:</strong> {{ $evento['lugar'] }}</li>
          <li> <strong>Fecha de Inicio:</strong> {{ $evento['fecha_inicio'] }}</li>
          <li> <strong>Fecha de Finalización:</strong> {{ $evento['fecha_fin'] }}</li>
          <li> <strong>Estado:</strong> {{ $evento['estado'] }}</li>
          <li>
            <strong>Áreas:</strong>
            @foreach ($evento->areas as $area)
                {{ $area->area->nombre }}
            @endforeach
          </li>
          <li>
            <strong>Tipo de Actividades:</strong>
            @foreach ($evento->tipoActividad as $tipo)
                {{ $tipo->tipoActividad->nombre }}
            @endforeach
          </li>
        </ul>
      </li>

      <li class="collection-item">
        <ul>
          <li> <strong>Comité:</strong></li>
          <ul>
          @foreach ($evento->comites as $comite)
              <li>{{ $comite->user->nombre }}</li>
          @endforeach
          </ul>
          <li> <strong>Jurado:</strong></li>
          <ul>
          @foreach ($evento->jurados as $jurado)
              <li>{{ $jurado->user->nombre }}
                  (
                  @foreach ($jurado->areas as $area)
                    {{ $area->area->nombre }},
                  @endforeach
                  )
              </li>
          @endforeach
          </ul>
        </ul>
      </li>      
      <li class="collection-item">
        <p>Actividades</p>        
        <a class="btn" href="{{ route('evento.actividad.index',$evento->id)}}">Ver actividades</a>
        @can ('modify',$evento)
          <a class="btn" href="{{ route('evento.actividad.create',$evento->id)}}">Crear actividades</a>            
          <a class="btn" href="{{ route('evento.organizar',$evento->id) }}">Ordenar Actividades</a>
        @endcan
      </li>
      <li class="collection-item">
        <p>Propuestas</p>
        <a class="btn" href="{{ route('evento.propuesta.index',$evento->id)}}">Ver propuestas</a>
        <a class="btn" href="{{ route('evento.propuesta.create',$evento->id)}}">Enviar Propuesta</a>
      </li>
      <li class="collection-item">
        <p>Organización</p>        
        @can ('modify',$evento)            
          <a class="btn" href="{{ route('evento.comite.create',$evento->id) }}">Asignar Comité</a>
          <a class="btn" href="{{ route('evento.jurado.create',$evento->id) }}">Asignar Jurado</a>
        @endcan
      </li>      
    </ul>
  </div>
@endsection