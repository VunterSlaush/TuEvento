@extends('layouts.app')

@section('content')
  <div class="container">
    <nav id="breadcrumb-nav" class="hide-on-med-and-down">
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="/home" class="breadcrumb"> Dashboard</a>
          <a href="/misEventos" class="breadcrumb"> Mis Eventos</a>
          <a href="{{ route('evento.show',$evento->id)}}" class="breadcrumb"> {{$evento->nombre}}</a>
          <a href="#" class="breadcrumb"> Editar Propuesta</a>
        </div>
      </div>
    </nav>
    <h1> Editar Propuesta</h1>

    {{Html::ul($errors->all())}}

    {{Form::model($propuesta, array('route' => array('evento.propuesta.update',$evento->id,$propuesta->id), 'method' => 'PUT'))}}
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
