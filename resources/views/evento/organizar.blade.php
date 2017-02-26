@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Organizador</h1>

  {{Html::ul($errors->all())}}

    <div class="row">
      <div class="col s3">
        <table id="title_table">
          <thead>
            <tr>
              <th> Titulo</th>
            </tr>
          </thead>
          <tbody id="sortable">
            @foreach($actividades as $actividad)
              <tr>
                <td id="{{$actividad->id}}">
                  {{$actividad->titulo}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    <div class="col s9">
      <table id="content_table">
        <thead>
          <tr>
            <th> Inicio </th>
            <th> Fin </th>
            <th> Fecha </th>
            <th> Accion</th>
          </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
              <tr>
                {{Form::model($evento, array('route' => array('evento.update', $evento->id), 'method' => 'PUT'))}}

                <td>
                  {{Form::time('hora_inicio',$actividad->hora_inicio)}}
                </td>
                <td>
                  {{Form::time('hora_fin',$actividad->hora_fin)}}
                </td>
                <td>
                {{Form::date('fecha',$actividad->fecha)}}
                </td>
                <td class="action">
                  <input type="checkbox" class="button"/>
                  <label>listo</label>
                </td>
              </tr>
           {{Form::close()}}
            @endforeach
        </tbody>
      </table>

    </div>
    </div>
  </div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $( function(){
      $("#sortable").sortable({
        placeholder: "ui-state-highlight"
      });
      $("#sortable").disableSelection();
    });
  });

  $(".action").each(function(i){
    $(this).find("input").attr('id','button_' + i,'name','button_' + i);
    $(this).find("label").attr('for','button_' + i);
  });

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $(".button").click(function(e) {
    var index = $(this).parent().parent().index();
    var activityIndex = $("#title_table tr").eq(index+1).find("td").attr("id");
    var content = $("#content_table tr");
    var form_ = $('#content_table tr').eq(index).find('form');
    var data = $(form_.serializeArray());
    data.id = activityIndex;
    data._token = CSRF_TOKEN;

    console.log(data + " -- " + activityIndex);
    updateActivity(data);

  });

  function updateActivity(data_out)
  {
        $.ajax({
        url: '/schedulerUpdate',
        type: 'POST',
        data: data_out,
        dataType: 'JSON',
        success: function (data)
        {
            console.log(data);
        }
    });
  }
</script>
@endsection
