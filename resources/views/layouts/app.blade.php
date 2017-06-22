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
</head>
<body class="raleway" style="background-color: #293a46">

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top" style="background-color: #434857 !important; border-bottom: 1px solid rgba(255, 255, 255, 0.2)">
            <button class="navbar-toggler navbar-toggler-right" style="border-color: #5cb85c" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: #5cb85c;">#SMRGE</a>

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
                <nav class="col-sm-3 col-md-1 hidden-xs-down bg-inverse sidebar" style="padding-left: 0px !important;padding-right: 0px;!important;background-color: #434857 !important;">
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
        @endif
                <main class="col-sm-9 offset-sm-3 col-md-11 offset-md-1 col-lg-11 offset-lg-1 pt-3">
                    @yield('content')
                </main>
            </div>
    </div>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{asset('assets/js/enum_select.js')}}"></script>
</body>
</html>
