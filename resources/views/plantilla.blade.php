<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>@yield("title")</title>
  </head>
  <body>
    @auth
    <div id="navbar" class="sticky"> 
        <a href="/agregar-post"><span>+</span> Agregar Post</a>
        <a href="/post-list">Posts</a>
        <a class="cerrar-sesion" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">                 
          {{ __('Cerrar Sesión') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F3EDE6; margin-top:51px;">
            <div class="container">
                <a class="navbar-brand" href="/"><span class="point">#</span> Posts</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item menu-list">
                            <a class="nav-link" href="/">Articulos<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item menu-list">
                            <a class="nav-link" href="/contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    @else
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F3EDE6;">
            <div class="container">
                <a class="navbar-brand" href="/"><span class="point">#</span> Posts</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item menu-list">
                            <a class="nav-link" href="/">Articulos<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item menu-list">
                            <a class="nav-link" href="/contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    @endauth

    <header>
    @yield("navigation")
    </header>

    <div class="page-body">
    @yield("content")
    </div>
    <script src="{{ url('js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    @yield("scripts")
  </body>
</html>