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
                <td>
                  <input type="hidden" name="id" value="{{$actividad->id}}">
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
                  <td>
                    <input type="time" name="hora_inicio" value="{{$actividad->hora_inicio}}">
                  </td>
                  <td>
                    <input type="time" name="hora_fin" value="{{$actividad->hora_fin}}">
                  </td>
                  <td>
                    <input type="date" name="fecha" value="{{$actividad->fecha}}">
                  </td>
                  <td class="action">
                    @if ($actividad->hora_inicio)
                      <input type="checkbox" class="check" checked/>
                      <label>listo</label>
                    @else
                      <input type="checkbox" class="check"/>
                      <label>listo</label>
                    @endif
                  </td>
              </tr>
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

    disableChecked();
  });

  function disableChecked() {
    $(".check").each(function() {
      if ($(this).prop("checked")){
          var contentTable = $(this).parent().parent();
          var index = contentTable.index();
          var titleTable = $("#title_table tr").eq(index+1);

          console.log("hola");
        titleTable.prop("class","ui-state-disabled");
        contentTable.find("input").prop("disabled",true);
        $(this).prop("disabled",false);

      }
    });
  }

  $(".action").each(function(i){
    $(this).find("input").attr('id','button_' + i,'name','button_' + i);
    $(this).find("label").attr('for','button_' + i);
  });

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $(".check").click(function(e) {
    var contentTable = $(this).parent().parent();
    var index = contentTable.index();
    var titleTable = $("#title_table tr").eq(index+1);

    var checkCont = $(this).parent();

    if (!$(this).prop("checked")){
      contentTable.find("input").prop("disabled",false);
      titleTable.removeProp("class","ui-state-disabled");
    }else{
      $(this).prop('checked',false);
      checkCont.find("label[for='"+$(this).attr("id")+"']").text("Aplicando");

      var activityIndex = titleTable.find("input[name='id']").attr("value");
      var inputs = $('#content_table tr').eq(index+1).find("input");
      var data = $(inputs.serializeArray());
      var data_out = JSON.stringify({
        id : activityIndex,
        hora_inicio : data[0].value,
        hora_fin : data[1].value,
        fecha : data[2].value
      });


      contentTable.find("input").prop("disabled",true);
      titleTable.prop("class","ui-state-disabled");

      titleTable.find("input[name='id']").attr("value");
      updateActivity(data_out,$(this));
    }
  });

  function updateActivity(data_out,check)
  {
        $.ajax({
        url: '/schedulerUpdate',
        type: 'POST',
        data: {_token:CSRF_TOKEN,actividad:data_out},
        dataType: 'JSON',
        success: function (data)
        {
            console.log(data.success);
            if(data.success == 'true'){
                check.prop('checked',true);
                $("#content_table ").find("label[for='"+check.attr("id")+"']").text("listo");
                check.removeAttr("disabled");
            }
            else
              check.prop('checked',false);
        }
    });
  }
</script>
@endsection
