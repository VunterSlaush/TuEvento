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
    <link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"> 
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
                  <a id="search-btn">
                    <i class="material-icons">search</i>
                  </a>
                </li>
                <li>
                  <a id="user-btn">
                    <i class="material-icons">person_pin</i>
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
                    <a href="{{ url('/evento/create') }}" class="collection-item"> Crear Evento</a>
                  </ul>
                </div>
              </li>
              <li>
                <a href="{{ url('/misActividades') }}" class="collapsible-header"> Mis Actividades </a>
              </li>
              <li>
                <a href="{{ url('/propuesta') }}" class="collapsible-header"> Mis Propuestas </a>
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
                  <select id="search-select" class="white">
                    <option  value="1" selected>Evento</option>
                    <option  value="2">Actividad</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="search-results">
              <div class="results-header">
              Resultados de Busqueda
              </div>
              <ul class="results-list collection" style="overflow-y : auto;">

              </ul>
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
    <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script>
    // TODO, PASAR TOOOOOODO ESTO A UN ARCHIVO !

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

      $("#search-field").keyup(function()
      {
            var select_value = $("#search-select").val();
            if($(this).val() != "")
              searchBySelect(select_value,$(this).val());
            else {
              $('.results-list').empty();
            }
      });

      function searchBySelect(value, searchValue)
      {
          console.log(value);
          switch (value)
          {
            case "1": // Search por Evento
                searchByEvento(searchValue);
              break;
            case "2": // Search por Actividad
                searchByActividad(searchValue);
              break;
            default:
              searchByActividad(searchValue);
              break;
          }
      }

      function searchByEvento(value)
      {
            $.ajax({
            url: '/searchEvento/'+value,
            type: 'GET',
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            success: function (data)
            {
                console.log(data);
                $('.results-list').empty();
                for (var i = 0; i < data.length; i++) {
                  //TODO, front de estos datos!
                  $('.results-list').append(
                                '<a href="/evento/'+data[i].id+'" class="collection-item avatar">'+
                                  '<i class="material-icons circle">folder</i>'+
                                      '<span class="title">'+data[i].nombre+'</span>'+
                                      '<p>'+data[i].lugar+ '<br>'+
                                         data[i].fecha_inicio+' - '+data[i].fecha_fin+
                                      '</p>'+
                                '</a>');
                }

            }
        });
      }

      function searchByActividad(value)
      {
        $.ajax({
        url: '/searchActividad/'+value,
        type: 'GET',
        data: {_token: CSRF_TOKEN},
        dataType: 'JSON',
        success: function (data)
          {
              console.log(data);
              $('.results-list').empty();
              for (var i = 0; i < data.length; i++) {
                $('.results-list').append(
                                    '<a href="/actividad/'+data[i].id+'" class="collection-item avatar">'+
                                        '<i class="material-icons circle">folder</i>'+
                                          '<span class="title">'+data[i].titulo+'</span>'+
                                          '<p>'+data[i].fecha+ '<br>'+
                                           data[i].hora_inicio+' - '+data[i].hora_fin+
                                          '</p>'+
                                    '</a>');
              }

          }
        });
      }

    </script>
    @yield('scripts')
</body>
</html>
