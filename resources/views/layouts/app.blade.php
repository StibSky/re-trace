<!doctype html>
<!--
MAIN blade. used to set layout of most pages, includes header and footer
sets up the navbar and yields the content of the other pages
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Re-trace.io</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('/js/bootstrap') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
@yield('head-script')
<!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/webkit.css')}}" media="screen and (-webkit-min-device-pixel-ratio:0)"
          type="text/css"/>
    @yield('stylesheet')
</head>

<body>
<div id="page-container">
    <div id="content-wrap">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: white">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{url('/images/retracelogo.png')}}" alt="Image"/>

                        Re-trace.io
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            @if(count(config('app.languages')) > 1)
                                <li class="nav-item dropdown d-md-down-none">
                                    <a class="nav-link" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="true" aria-expanded="false">
                                        {{ strtoupper(app()->getLocale()) }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @foreach(config('app.languages') as $langLocale => $langName)
                                            <a class="dropdown-item"
                                               href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }}
                                                ({{ $langName }})</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->first_name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            {{ __("My profile")}}
                                        </a>
                                        <a class="dropdown-item" href="https://re-trace.io" target="_blank">
                                            {{ __("About")}}
                                        </a>
                                        <div style="border-top: 1px solid lightslategray;">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </div>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container-fluid px-5">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </main>
        </div>
        <footer class="site-footer">
            <div class="container-fluid">
                <div class="row d-flex justify-content-between px-2">
                    <div class="col-12 col-md-3 col-lg">
                        <div class="links text-center text-md-left">
                            <a href="https://re-trace.io" target="_blank"><span>{{ __("About")}}</span></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg">
                        <p class="text-center">&copy; 2020 - Re-trace.io</p>
                    </div>
                    <div class="col-12 col-md-3 col-lg">
                        <ul class="social-icons text-center text-md-right">
                            <li><a class="socialmedia" href="https://www.instagram.com/re_trace.io/" target="_blank"><i
                                        class="fa fa-socialmedia"><img src="{{url('/images/instagram.png')}}"
                                                                       width="25px"
                                                                       height="auto"></i></a></li>
                            <li><a class="linkedin" href="https://www.linkedin.com/company/re-trace-io/"
                                   target="_blank"><i
                                        class="fa fa-linkedin"><img src="{{url('/images/linkedIn.png')}}" width="25px"
                                                                    height="auto"></i></a></li>
                        </ul>
                    </div>
                </div>
                <hr>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="{{mix('/js/app.js')}}"></script>
@stack('script')
</body>
<!-- Site footer -->

</html>
