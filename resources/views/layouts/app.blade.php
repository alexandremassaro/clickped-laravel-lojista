<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ClickPed</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo_hor_dark_150.png" alt="logo clickped">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item pl-2">
                                <a class="nav-link btn btn-outline-secondary text-secondary" href="{{ route('cadastrar_estabelecimento') }}">Cadastrar estabelecimento</a>
                            </li>
                            <li class="nav-item pl-2">
                                <a class="nav-link btn btn-outline-secondary text-secondary" href="{{ route('login') }}">Já sou parceiro</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" style="width: 15rem" aria-labelledby="navbarDropdown">
                                    <div class=" justify-content-between text-center py-4">
                                        <img src="/images/logo_ver_dark_150.png" alt="Foto do cliente" class="rounded-circle">
                                    </div>
                                    <div class=" justify-content-between text-center font-weight-bold">
                                        <h4>Nome do cliente</h4>
                                    </div>
                                    <div class=" justify-content-between text-center font-weight-bold">
                                        email@cliente.com
                                    </div>
                                    <hr/>
                                    <a class="dropdown-item  justify-content-between text-center" href="{{ route('home') }}">
                                        <div class="row">
                                            <div class="col-1"><i class="fas fa-list-ul"></i></div>
                                            <div class="col text-left">Meus estabelecimentos</div>
                                        </div>
                                    </a>
                                    <hr/>
                                    <a class="dropdown-item justify-content-between w-100" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <div class="row">
                                                         <div class="col-1"><i class="fas fa-sign-out-alt"></i></div>
                                                         <div class="col text-left">Sair</div>
                                                     </div>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
