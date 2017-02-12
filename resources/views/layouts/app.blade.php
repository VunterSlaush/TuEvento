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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav>
          <div class="nav-wrapper">
            <div class="container">
              <a href="{{ url('/home') }}" class="brand-logo">TuEvento</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Ingreso</a></li>
                    <li><a href="{{ url('/register') }}">Registro</a></li>
                @else
                  <a class='dropdown-button' href='#' data-activates='dropdown1'>
                    {{ Auth::user()->nombre }}<span class="caret"></span>
                  </a>
                  <!-- Dropdown Structure -->
                  <ul id='dropdown1' class='dropdown-content'>
                    <!--TODO mostrar tips del menu segun permisos  -->
                    <li><a href="{{ url('/miHorario') }}">Mi Horario</a></li>
                    <li><a href="{{ url('/misEventos') }}">Mis Eventos</a></li>
                    <li><a href="{{ url('/propuesta') }}">Mis Propuestas</a></li>
                    <li><a href="{{ url('/misActividades') }}">Mis Actividades</a></li>
                    <li><a href="{{ url('/misCertificados') }}">Mis Certificados</a></li>
                    <li><a href="{{ url('/califica') }}">Mis Calificaciones</a></li>
                    <li class="divider"></li>
                    <li>
                      <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout</a>
                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                @endif
              </ul>
            </div>
          </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

    @yield('scripts')
</body>
</html>
