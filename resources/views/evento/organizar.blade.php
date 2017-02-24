@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Organizador</h1>

  {{Html::ul($errors->all())}}

    <table>
      <thead>
        <tr>
          <th> Titulo </th>
          <th> Inicio </th>
          <th> Fin </th>
          <th> Fecha </th>
          <th> Accion</th>
        </tr>
      </thead>
      <tbody>
        {{Form::model($evento, array('route' => array('evento.update', $evento->id), 'method' => 'PUT'))}}
          @foreach($actividades as $actividad)
            <tr>
              <td>
                {{$actividad->titulo}}
              </td>
              <td>
                {{Form::time('hora_inicio',$actividad->hora_inicio)}}
              </td>
              <td>
                {{Form::time('hora_fin',$actividad->hora_fin)}}
              </td>
              <td>
              {{Form::date('fecha',$actividad->fecha)}}
              </td>
              <td>
                <input type="checkbox" id="listo" name="listo" />
                <label for="listo">listo</label>
              </td>
            </tr>
          @endforeach
       {{Form::submit('Organizar')}}
       {{Form::close()}}
      </tbody>
    </table>
  </div>
@endsection
