<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->app_name }}</title>

    <link rel="shortcut icon" type="image/ico" href="{{ asset('images/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    {{-- <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ $settings->app_name }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @foreach ($modules as $aba => $menus)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ $aba }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @foreach ($menus as $menu)
                                        <a class="dropdown-item" href="{{ route($menu['route']) }}">
                                            {{ $menu['name'] }}
                                        </a>
                                    @endforeach
                                </div>
                            <li>
                        @endforeach
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="rounded-circle" src="{{ uploads_path(Auth::user()->avatar) }}" width="25" />&nbsp;
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @can('profile.edit')
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <span class="fa fa-user-edit text-gray-400"></span>&nbsp; Alterar Usuário
                                </a>
                                @endcan

                                @can('profile')
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <span class="fa fa-user-circle text-gray-400"></span>&nbsp; Meu Perfil
                                </a>
                                @endcan
                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="fa fa-sign-out-alt text-gray-400"></span>&nbsp; {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main id="content-box" class="py-4 content">
            <div class="container">
                @include('components.errors')
                @include('sweetalert::alert')

                @yield('content')
            </div>
        </main>

        <div id="footer" class="footer">
            Developed by <strong>{{ $settings->app_name }}</strong> &copy; {{ now()->year }}
        </div>
    </div>

    <script>
        const pageHeight = window.innerHeight - 100
        document.getElementById('content-box').style.minHeight = `${pageHeight}px`
    </script>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('plugins/fileinput/js/fileinput.js') }}"></script>
    <script src="{{ asset('plugins/fileinput/themes/fas/theme.min.js') }}"></script>
    <script src="{{ asset('plugins/fileinput/js/locales/pt-BR.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    {{-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ asset('js/custom.js') }}" defer></script>

    @stack('scripts')
</body>
</html>
