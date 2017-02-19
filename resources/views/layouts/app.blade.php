<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/search_box.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app" class="navbar-fixed">
        <nav>
          <div class="nav-wrapper">
            <div class="container">
              <a href="{{ url('/home') }}" class="brand-logo">TuEvento</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Ingreso</a></li>
                    <li><a href="{{ url('/register') }}">Registro</a></li>
                @else
                <li>
                <div style="margin-right:5px;">
                  {{ Auth::user()->nombre }}
                </div>
                </li>
                <li>
                  <a id="search-btn">
                    <i class="material-icons">search</i>
                  </a>
                </li>

                @endif
              </ul>
            </div>
          </div>
        </nav>

        @if (!Auth::guest())
          <ul id="slide-out" class="side-nav fixed">
            <li class="profile-head">
            <div class="profile-img valign-wrapper">
              <img class="circle valign" src="https://d13yacurqjgara.cloudfront.net/users/759254/screenshots/2578941/calendar_1_1x.png" alt="">
            </div>
            <h5 class="title center-align">{{Auth::user()->nombre}} </h5>
          </li>
            <li class="slide-content">
            <ul class="collapsible" data-collapsible="accordion">
              <li>
                <a  class="collapsible-header" href="{{ url('/miHorario') }}">Mi Horario</a>
              </li>
              <li>
                <div class="collapsible-header"> Eventos </div>
                <div class="collapsible-body">
                  <ul class="collection">
                    <a href="{{ url('/misEventos') }}" class="collection-item"> Mis Eventos</a>
                    <a href="{{ url('/evento') }}" class="collection-item"> Ver todos</a>
                    <a href="{{ url('/evento/create') }}" class="collection-item"> Crear Evento</a>
                  </ul>
                </div>
              </li>
              <li>
                <div class="collapsible-header"> Actividades </div>
                <div class="collapsible-body">
                  <ul class="collection">
                    <a href="{{ url('/misActividades') }}" class="collection-item"> Mis Actividades</a>
                    <a href="{{ url('/actividad') }}" class="collection-item"> Ver todas</a>
                  </ul>
                </div>
              </li>
              <li>
                <div class="collapsible-header"> Propuestas </div>
                <div class="collapsible-body">
                  <ul class="collection">
                    <a href="{{ url('/propuesta') }}" class="collection-item"> Mis Propuestas</a>
                  </ul>
                </div>
              </li>
              <li>
                <a class="collapsible-header"  href="{{ url('/misCertificados') }}">Mis Certificados</a>
              </li>
              <li>
                <ul>
                  <a  class="collapsible-header" href="{{ url('/califica') }}">Calificar</a>
                </ul>
              </li>
              <li>
                <ul>
                  <a  class="collapsible-header" href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Cerrar Sesion</a>
                             <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                             </form>
                </ul>
              </li>
            </ul>
          </li>
          </ul>
        @endif
        <!-- <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a> -->
        <div class="search-drawer z-16 s-closed">
          <div class="search-tool">
            <div class="row">
                <div id="search-close" class="col s1">
                  <i class="material-icons">clear</i>
                </div>
                <h5 class="col s3" style="color:white;">Buscar</h5>
            </div>
            <div>
              <form class="row">
                <div class="col s8">
                  <input id="search-field" placeholder="Ingrese Busqueda" type="text">
                </div>
                <div class="col s4">
                  <select>
                    <option value="" disabled selected>Buscar Por</option>
                    <option value="1">Evento</option>
                    <option value="2">Area</option>
                    <option value="4">Tipo</option>
                    <option value="3">Actividad</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="search-results">
              <div class="results-header">
              Resultados de Busqueda
              </div>
              <div class="results-list" style="overflow-y : auto;">

              </div>
            </div>
          </div>
        </div>
        <div id="overlay"></div>
        <div class="content">
          @yield('content')
        </div>
    </div>



    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script>

      $(document).ready(function() {
        $('select').material_select();
      });


      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#search-btn').click(function(){
            $('.search-drawer').removeClass('s-closed').addClass('s-opened');
            $('#overlay').toggle();
      });

      $('#search-close, #overlay').click(function(){
        $('.search-drawer').removeClass('s-opened').addClass('s-closed');
        $('#overlay').toggle();
      });

      $("#search-field").change(function()
      {
            $.ajax({
            url: '/search/'+$(this).val(),
            type: 'GET',
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            success: function (data)
            {   //TODO MODELAR LOS DATOS EN LA BUSQUEDA
                //TODO Poner 1 o varios botones en la busqueda!
                //TODO ehmmm ??
                console.log(data);
                $('.results-list').empty();
                for (var i = 0; i < data.length; i++) {
                  $('.results-list').append('<div class="result">'+
                                  '<div class="result-logo"></div>'+
                                    '<div class="result-text">'+
                                      '<span class="b-name results-t-more">'+data[i].nombre+'</span>'+
                                      //'<span class="b-sub results-t-more">Summary of Business</span>'+
                                      //'<span class="b-info results-t-more">Apple Valley, MN</span>'+
                                    '</div>'+
                                    '</div>');
                }

            }
        });
      });
    </script>
    @yield('scripts')
</body>
</html>
