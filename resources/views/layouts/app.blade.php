<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('libraries/popper.min.js') }}"></script>
    <script src="{{ asset('libraries/moment.min.js') }}"></script>
    <script src="{{ asset('libraries/date-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/custom-js.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/fontawesome-free-5.11.2-web/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('libraries/date-picker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light gardient-black shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
{{--                    {{ config('app.name', 'Laravel') }}--}}
                    <img class="image-logo-header" src="{{asset('img/logo-red-text.png')}}" width="100px" height="100px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item {{ Request::is('cars') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('cars') }}">{{ __('language.cars') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('language.offices') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">За нас</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('language.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('language.register') }}</a>
                                </li>
                            @endif
                            @else
                                @if (Auth::user()->role != 4)
                                <li class="nav-item {{ Request::is('admin*') ? ' active' : '' }}" >
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('language.controlPanel') }}</a>
                                </li>
                                @endif

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>


                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile') }}">Моя профил</a>
                                        <a class="dropdown-item" href="{{ url('home') }}">Мойте резервации</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                                @php $locale = session()->get('locale'); @endphp

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('language.lang') }} <span class="caret"></span>
                                    </a>
                                    {{--<div class="lang-image">--}}
                                    {{--@switch($locale)--}}

                                    {{--@case('bg')--}}
                                    {{--<img src="{{asset('img/bg.png')}}" width="30px" height="20x"> Български--}}
                                    {{--@break--}}
                                    {{--@case('ru')--}}
                                    {{--<img src="{{asset('img/ussr.png')}}" width="30px" height="20x"> Руский--}}
                                    {{--@break--}}
                                    {{--@case('de')--}}
                                    {{--<img src="{{asset('img/de.png')}}" width="30px" height="20x"> Deutsch--}}
                                    {{--@break--}}
                                    {{--@default--}}
                                    {{--<img src="{{asset('img/en.png')}}" width="30px" height="20x"> English--}}

                                    {{--@endswitch--}}

                                    {{--</div>   --}}

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="lang/en"><img src="{{asset('img/en.png')}}" width="30px" height="20x"> English</a>
                                        <a class="dropdown-item" href="lang/bg"><img src="{{asset('img/bg.png')}}" width="30px" height="20x"> Български</a>
                                        <a class="dropdown-item" href="lang/ru"><img src="{{asset('img/ussr.png')}}" width="30px" height="20x"> Руский</a>
                                        <a class="dropdown-item" href="lang/de"><img src="{{asset('img/de.png')}}" width="30px" height="20x"> Deutsch</a>
                                    </div>

                                </li>
                                <li class="nav-item dropdown">
                                <div class="lang-image" style="margin-top: 6px; color: #fff">
                                    @switch($locale)

                                        @case('bg')
                                        <img src="{{asset('img/bg.png')}}" width="30px" height="20x"> Български
                                        @break
                                        @case('ru')
                                        <img src="{{asset('img/ussr.png')}}" width="30px" height="20x"> Руский
                                        @break
                                        @case('de')
                                        <img src="{{asset('img/de.png')}}" width="30px" height="20x"> Deutsch
                                        @break
                                        @default
                                        <img src="{{asset('img/en.png')}}" width="30px" height="20x"> English

                                    @endswitch

                                </div>
                                </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            <div class="main-home">
            @yield('content')
            </div>
        </main>
        {{--<!-- start footer Area -->--}}
        {{--<footer class="footer-area section-gap">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg-2 col-md-6 col-sm-6">--}}
                        {{--<div class="single-footer-widget">--}}
                            {{--<h6>Quick links</h6>--}}
                            {{--<ul>--}}
                                {{--<li><a href="#">Jobs</a></li>--}}
                                {{--<li><a href="#">Brand Assets</a></li>--}}
                                {{--<li><a href="#">Investor Relations</a></li>--}}
                                {{--<li><a href="#">Terms of Service</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-2 col-md-6 col-sm-6">--}}
                        {{--<div class="single-footer-widget">--}}
                            {{--<h6>Resources</h6>--}}
                            {{--<ul>--}}
                                {{--<li><a href="#">Guides</a></li>--}}
                                {{--<li><a href="#">Research</a></li>--}}
                                {{--<li><a href="#">Experts</a></li>--}}
                                {{--<li><a href="#">Agencies</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-2 col-md-6 col-sm-6 social-widget">--}}
                        {{--<div class="single-footer-widget">--}}
                            {{--<h6>Follow Us</h6>--}}
                            {{--<p>Let us be social</p>--}}
                            {{--<div class="footer-social d-flex align-items-center">--}}
                                {{--<a href="#"><i class="fa fa-facebook"></i></a>--}}
                                {{--<a href="#"><i class="fa fa-twitter"></i></a>--}}
                                {{--<a href="#"><i class="fa fa-dribbble"></i></a>--}}
                                {{--<a href="#"><i class="fa fa-behance"></i></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</footer>--}}



    </div>
</body>
</html>
