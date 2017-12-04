<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IDSuite') }}</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/all.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/css/tether.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    @if($viewname === 'OAuth')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    @endif

    @if($viewname === 'account' || $viewname === 'device' || $viewname === 'case')
        <link rel="stylesheet" href="{{asset('assets/css/custom_tabs.css')}}">
    @endif


</head>

    <body class="raleway" style="background-color: #293a46;">



    @if($viewname !== 'OAuth' && Request::url() !== 'http://idsuite.dev' && Request::url() !== 'http://idsuite.dev/login')

    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top custom-nav">
            <button class="navbar-toggler navbar-toggler-right custom-border-color-green" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ml-2 mr-lg-5 custom-navbar-brand" href="/measure/accounts">
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="-5 0 120 95" height="45">
                    <defs>
                        <style>
                            .cls-1{fill:none;}
                            .cls-2{fill:#346852;}
                            .cls-3{fill:#d59043;}
                            .cls-4{fill:#d16a3d;}
                            .cls-5{fill:#52b6df;}
                            .cls-6{fill:#ed946e;}
                            .cls-7{fill:#1aa7dc;}
                            .cls-8{fill:#43ba8a;}
                            .cls-9{fill:#f3e076;}
                            .cls-10{fill:#a0d0ec;}
                        </style>
                    </defs>
                    <title>HEX_2</title>
                    <polygon class="cls-1" points="11.54 25.13 11.47 25.24 11.61 25.24 11.54 25.13"/>
                    <polygon class="cls-2" points="71.49 22.28 73.2 25.24 92.75 25.24 81.47 5.72 71.49 22.28"/>
                    <polygon class="cls-3" points="84.68 45.11 75.63 60.76 95.17 60.76 104.22 45.11 94.13 27.64 82.9 42.03 84.68 45.11"/>
                    <polygon class="cls-4" points="70.48 69.68 80.32 86.48 95.17 60.76 75.63 60.76 70.48 69.68"/>
                    <polygon class="cls-5" points="11.54 25.13 11.61 25.24 31.01 25.24 32.53 22.61 22.7 5.82 11.54 25.13"/>
                    <polygon class="cls-6" points="70.48 69.68 68.39 73.3 58.52 73.3 45.33 90.21 78.16 90.21 80.32 86.48 70.48 69.68"/>
                    <polygon class="cls-7" points="32.53 22.61 35.82 16.91 68.39 16.91 71.49 22.28 81.47 5.72 78.16 0 26.05 0 22.7 5.82 32.53 22.61"/>
                    <polygon class="cls-8" points="82.9 42.03 94.13 27.64 92.75 25.24 73.2 25.24 82.9 42.03"/>
                    <polygon class="cls-9" points="31.01 25.26 31.01 25.24 11.61 25.24 11.47 25.24 11.47 25.26 31.01 25.26"/>
                    <polygon class="cls-9" points="58.52 73.3 45.33 90.22 26.05 90.22 18.36 76.91 18.66 76.44 28.59 60.78 35.29 72.39 35.82 73.3 58.52 73.3"/>
                    <polygon class="cls-10" points="28.59 60.77 19.54 45.11 31.01 25.26 11.47 25.26 0 45.11 18.36 76.9 18.66 76.44 28.59 60.77"/>
                </svg>

            </a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-lg-3 mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link">

                            @if($viewname === 'account')
                                {{$entity->contact->name->name}}
                            @elseif($viewname === 'device')
                                {{$endpoint->name}}
                            @else
                                {{ucwords($viewname)}}
                            @endif

                            <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav" >
                    <!-- Authentication Links -->
                    @if (!Auth::guest())

                        <li class="mr-5 dropdown">
                            <button class="dropdown-toggle btn btn-outline-pink text-white custom-border-color-pink" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->getEmailUsername()}}
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="/apps">App Select</a>
                                <a class="dropdown-item" href="/measure/stats">Product Stats</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" >Logout</a>
                            </div>
                        </li>

                        {{--<form class="form-inline my-2 my-lg-0">--}}
                            {{--<input class="form-control mr-sm-2" type="text" placeholder="Search">--}}
                            {{--<button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Search</button>--}}
                        {{--</form>--}}

                    @endif
                </ul>
            </div>
        </nav>

    @endif

    <div class="container-fluid">

        @if (!auth::guest() && $viewname !== 'App Selection' && $viewname !== 'Trust' && $viewname !== 'OAuth')
            <div class="row">

                {{--<div class="col-sm-3 col-md-1 col-lg-1 hidden-xs-down bg-inverse sidebar" style="padding-left: 0px !important; padding-right: 0px;!important;background-color: #434857 !important; border-right: 2px solid rgba(255, 255, 255, 0.2);">--}}

                    {{--<nav>--}}
                        {{--<ul class="nav nav-pills flex-column" id="measure-links">--}}
                    {{--</ul>--}}
                {{--</nav>--}}

                    {{--<div style="color:red; position: absolute;bottom: 10px;left:20px;width: 100%;padding-right: 30px;">--}}
                        {{--<embed id="white-logo" class="w-100" type="image/svg+xml" src="{{ asset('img/logo_white.svg') }}"/>--}}
                    {{--</div>--}}
                {{--</div>--}}


                <main class="col-sm-12  col-md-12 col-lg-12 pt-3">
                    @yield('content')
                </main>


        @else
                    <main class="col-sm-1 col-md-12  col-lg-12  pt-3">
                        @yield('content')
                    </main>
        @endif

            </div>


    </div>
    <!-- Scripts -->

    @include('scripts.app')

</body>
</html>

