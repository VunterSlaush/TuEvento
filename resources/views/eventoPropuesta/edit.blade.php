@extends('layouts.app')

@section('content')
  <div class="container">
    <h1> Editar Propuesta</h1>

    {{Html::ul($errors->all())}}

    {{Form::model($propuesta, array('route' => array('evento.propuesta.update',$id_evento,$propuesta->id), 'method' => 'PUT'))}}
    <ul class="collapsible" data-collapsible="accordion">
      <li>
        <div class="collapsible-header active"><i class="material-icons">assignment</i> Información a Editar*</div>
        <div class="collapsible-body">
          <div class="container form-container">
            <div class="row">
              <div class="col m6">
                {{Form::label('titulo','Titulo')}}
                {{Form::text('titulo')}}
              </div>
              <div class="col m6">
                {{Form::label('adjunto','Adjunto')}}
                {{Form::File('adjunto',['style' => 'display:none'])}}
                <br>
                <a class="btn waves-light" href="#!" onclick="inputFileClick()">
                  <i class="material-icons left">file_upload</i>Cambiar
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col m12 input-field">
                {{Form::label('descripcion','Descripcion')}}
                {{Form::text('descripcion',$propuesta->descripcion,['data-length' => '120','maxlength' => '120'])}}
              </div>
            </div>
            <div class="row">
              <div class="col m12">
                {{Form::label('demanda','Demanda')}}
                {{Form::text('demanda',$propuesta->demanda,['data-length' => '120','maxlength' => '120'])}}
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>

    <center>{{Form::submit('Editar', ['class' => 'waves-effect waves-light btn'])}}</center>

    {{Form::close()}}
  </div>
  @endsection

  @section('scripts')
  <script type="text/javascript">

    $(document).ready(function() {

    });

    function inputFileClick() {
      $("input[name='adjunto']").click();
    }
  </script>
  @endsection
