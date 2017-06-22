<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/all.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/css/tether.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.css')}}">
</head>
<body class="raleway" style="background-color: #293a46">

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top" style="background-color: #434857 !important; border-bottom: 2px solid rgba(255, 255, 255, 0.2)">
            <button class="navbar-toggler navbar-toggler-right" style="border-color: #5cb85c" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/accounts" style="color: #5cb85c;">

                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 25" width="155" height="21">
                    <defs>
                        <style>
                            .cls-1{fill:#fff;}
                            .cls-2{fill:#fff;}
                        </style>
                    </defs>
                    <title>Logo_WhiteLetters</title>
                    <path class="cls-1" d="M324.86,156.19a6.86,6.86,0,0,1,.53,2.72,7.13,7.13,0,0,1-3.13,6,13.57,13.57,0,0,1-8.26,2.31,14.54,14.54,0,0,1-7.75-1.85,8.62,8.62,0,0,1-3.91-5.36l7.09-.9A2.88,2.88,0,0,0,311,161a7.35,7.35,0,0,0,3.39.66,5.21,5.21,0,0,0,2.3-.42,1.29,1.29,0,0,0,.85-1.15c0-.68-.91-1.15-2.72-1.37-.91-.12-1.65-.22-2.21-.33l-.19,0c-3-.55-5.19-1.34-6.45-2.35a6.47,6.47,0,0,1-1.86-2.31,6.57,6.57,0,0,1-.66-2.87,7,7,0,0,1,2.88-5.85A12.23,12.23,0,0,1,314,142.8a12.85,12.85,0,0,1,6.68,1.59,8.73,8.73,0,0,1,3.83,4.64l-6.78,1.22a3.64,3.64,0,0,0-1.58-1.53,5.75,5.75,0,0,0-2.58-.5,3.79,3.79,0,0,0-1.88.36,1.19,1.19,0,0,0-.62,1.09c0,.73,1.16,1.26,3.49,1.59,1.13.17,2,.31,2.74.44l.27,0c2.8.54,4.72,1.28,5.8,2.26A6.43,6.43,0,0,1,324.86,156.19Z" transform="translate(-70.34 -134.88)"/>
                    <path class="cls-1" d="M301.52,151.22v14.85h-8.64V152.15a4.56,4.56,0,0,0-.5-2.41,1.77,1.77,0,0,0-1.58-.78,2.09,2.09,0,0,0-1.77.83,3.86,3.86,0,0,0-.63,2.39v13.88h-8.6V143.48h8v3.22a6.57,6.57,0,0,1,2.57-2.85,7.66,7.66,0,0,1,3.88-1q3.82,0,5.56,2T301.52,151.22Z" transform="translate(-70.34 -134.88)"/>
                    <path class="cls-1" d="M275.11,146.15a12.8,12.8,0,0,1,0,17.28,13.56,13.56,0,0,1-17.69,0,12.73,12.73,0,0,1,0-17.26,13.62,13.62,0,0,1,17.7,0Zm-5.84,8.66a11.46,11.46,0,0,0-.74-4.74,2.49,2.49,0,0,0-4.57,0,15.94,15.94,0,0,0,0,9.51,2.49,2.49,0,0,0,4.57,0A11.38,11.38,0,0,0,269.27,154.81Z" transform="translate(-70.34 -134.88)"/>
                    <polygon class="cls-1" points="182.5 8.6 182.5 31.2 173.53 31.2 173.53 14.31 173.53 8.6 182.5 8.6"/>
                    <rect class="cls-1" x="173.54" y="0.73" width="8.96" height="6.09"/>
                    <path class="cls-1" d="M238.18,136.21v7.27h4.26v5.71h-4.26v9a2.13,2.13,0,0,0,.48,1.58,2.29,2.29,0,0,0,1.63.47,5.86,5.86,0,0,0,1.06-.11c.41-.06.86-.16,1.37-.28v6.25q-1.4.31-2.71.47a21.22,21.22,0,0,1-2.53.16c-2.69,0-4.68-.59-6-1.79s-2-3-2-5.5V149.19H226.1v-5.71h3.78l.58-6.86Z" transform="translate(-70.34 -134.88)"/>
                    <path class="cls-1" d="M225,143.48v22.6h-8v-3.22a6.64,6.64,0,0,1-2.55,2.88,7.33,7.33,0,0,1-3.86,1q-3.83,0-5.56-2t-1.73-6.38V143.48h8.64v14a4.54,4.54,0,0,0,.5,2.38,1.73,1.73,0,0,0,1.57.78,2,2,0,0,0,1.76-.84,4,4,0,0,0,.62-2.39V143.48Z" transform="translate(-70.34 -134.88)"/>
                    <rect class="cls-1" x="122.41" y="0.73" width="8.96" height="30.46"/>
                    <path class="cls-1" d="M188.2,146.15a12.8,12.8,0,0,1,0,17.28,13.55,13.55,0,0,1-17.69,0,12.73,12.73,0,0,1,0-17.26,13.63,13.63,0,0,1,17.7,0Zm-5.84,8.66a11.46,11.46,0,0,0-.73-4.74,2.49,2.49,0,0,0-4.58,0,15.94,15.94,0,0,0,0,9.51,2.49,2.49,0,0,0,4.58,0A11.38,11.38,0,0,0,182.36,154.81Z" transform="translate(-70.34 -134.88)"/>
                    <path class="cls-1" d="M153.26,134.88a13.78,13.78,0,0,1,7.54,2,11.4,11.4,0,0,1,4.54,5.69l-7.81,2.23a4.76,4.76,0,0,0-1.83-2.34,5.84,5.84,0,0,0-3.07-.72,3.73,3.73,0,0,0-2.22.63,1.9,1.9,0,0,0-.9,1.57q0,1.5,3.92,2.38l1.65.38,1.09.25q5,1.21,7,2.85a7.69,7.69,0,0,1,2.19,2.81,8.87,8.87,0,0,1,.75,3.69,9,9,0,0,1-.77,3.68,9.2,9.2,0,0,1-2.23,3.11,12.72,12.72,0,0,1-4.48,2.68,16.65,16.65,0,0,1-5.71.93,16.93,16.93,0,0,1-9.42-2.42,11.05,11.05,0,0,1-4.78-6.86l0-.06,8.5-1.59a4.6,4.6,0,0,0,1.94,2.86,7.05,7.05,0,0,0,3.91.94,4.67,4.67,0,0,0,2.47-.58,1.74,1.74,0,0,0,.94-1.51q0-1.79-4-2.67c-.93-.22-1.66-.39-2.22-.54q-5.51-1.41-7.87-3.54a7,7,0,0,1-2.13-3.61,9.27,9.27,0,0,1,3.37-9.38Q147.33,134.88,153.26,134.88Z" transform="translate(-70.34 -134.88)"/>
                    <path class="cls-1" d="M138.81,157.33l0,.06v-.05Z" transform="translate(-70.34 -134.88)"/>
                    <path class="cls-2" d="M113,135.61h11.7a22.45,22.45,0,0,1,5,.5,12.17,12.17,0,0,1,3.82,1.52,13.26,13.26,0,0,1,4.86,5.44,15.84,15.84,0,0,1,1.4,4.16,19.16,19.16,0,0,1,.33,3.61,17.09,17.09,0,0,1-1.24,6.49h0v.05c-.08.2-.16.39-.25.58a12.8,12.8,0,0,1-8.55,7.42,21.39,21.39,0,0,1-5.69.69H113Zm17.2,15.08a10.23,10.23,0,0,0-1.5-5.89,4.61,4.61,0,0,0-4-2.19h-2.38v16.34h2.11a4.85,4.85,0,0,0,4.19-2.25A10.23,10.23,0,0,0,130.18,150.69Z" transform="translate(-70.34 -134.88)"/>
                    <rect class="cls-2" x="31.75" y="0.72" width="9.19" height="30.48"/>
                    <rect class="cls-2" x="23.04" y="22.89" width="5.32" height="5.1"/>
                    <rect class="cls-2" x="23.04" y="15.24" width="5.32" height="5.1"/>
                    <rect class="cls-2" x="23.04" y="7.59" width="5.32" height="5.11"/>
                    <rect class="cls-1" x="23.04" y="1.49" width="5.32" height="3.49"/>
                    <rect class="cls-2" x="14.23" y="19.61" width="4.32" height="4.14"/>
                    <rect class="cls-2" x="14.23" y="13.4" width="4.32" height="4.15"/>
                    <rect class="cls-2" x="14.23" y="7.18" width="4.32" height="4.14"/>
                    <rect class="cls-1" x="14.23" y="2.19" width="4.32" height="2.84"/>
                    <rect class="cls-2" x="6.65" y="16.77" width="3.5" height="3.34"/>
                    <rect class="cls-2" x="6.65" y="11.76" width="3.5" height="3.35"/>
                    <rect class="cls-2" x="6.65" y="6.75" width="3.5" height="3.34"/>
                    <rect class="cls-1" x="6.65" y="2.72" width="3.5" height="2.29"/>
                    <rect class="cls-2" y="14.58" width="2.79" height="2.67"/>
                    <rect class="cls-2" y="10.56" width="2.79" height="2.68"/>
                    <rect class="cls-2" y="6.54" width="2.79" height="2.67"/>
                    <rect class="cls-1" y="3.25" width="2.79" height="1.84"/>
                </svg>

            </a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link">{{$viewname}} <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav" >
                    <!-- Authentication Links -->
                    @if (!Auth::guest())

                        <li class="mr-5 dropdown">
                            <button class="dropdown-toggle btn btn-outline-pink" style="border-color: #E64759; color: white;" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->getEmailUsername()}}
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                                <a class="dropdown-item" href="#">Endpoint Control</a>
                                <a class="dropdown-item" href="#">Proxy Control</a>
                                <a class="dropdown-item" href="#">Customer Control</a>
                            </div>
                        </li>

                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search">
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Search</button>
                        </form>

                    @endif
                </ul>
            </div>
        </nav>

    <div class="container-fluid">

        @if (!auth::guest() && $viewname !== 'App Selection')
            <div class="row">
                <nav class="col-sm-3 col-md-1 hidden-xs-down bg-inverse sidebar" style="padding-left: 0px !important;padding-right: 0px;!important;background-color: #434857 !important; border-right: 2px solid rgba(255, 255, 255, 0.2);">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item ">
                            <a class="nav-link btn-outline-teal" style="color: white !important;" href="/accounts">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-pink" style="color: white !important;white-space: nowrap;" href="#">Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-purple" style="color: white !important;" href="#">Devices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-yellow" style="color: white !important;" href="#">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-blue" style="color: white !important; white-space: nowrap;" href="#">Support-Data</a>
                        </li>
                    </ul>
                </nav>

                <main class="col-sm-9 offset-sm-3 col-md-11 offset-md-1 col-lg-11 offset-lg-1 pt-3">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{asset('assets/js/enum_select.js')}}"></script>
</body>
</html>
