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
            <a class="navbar-brand ml-2 mr-lg-5" href="/accounts" style="color: #5cb85c;padding-bottom: 0 !important; font-size: 0;">
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
                            @if($viewname === 'account' || $viewname === 'device')
                                {{$name}}
                            @else
                                {{$viewname}}
                            @endif
                            <span class="sr-only">(current)</span></a>
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
                <nav class="col-sm-3 col-md-2 col-lg-2 hidden-xs-down bg-inverse sidebar" style="padding-left: 0px !important;padding-right: 0px;!important;background-color: #434857 !important; border-right: 2px solid rgba(255, 255, 255, 0.2);">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item ">
                            <a class="nav-link btn-outline-teal" style="color: white !important;" href="/accounts">Accounts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-pink" style="color: white !important;white-space: nowrap;" href="/transactions">Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-purple" style="color: white !important;" href="/devices">Devices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-yellow" style="color: white !important;" href="#">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-outline-blue" style="color: white !important; white-space: nowrap;" href="/tickets">Support-Data</a>
                        </li>
                    </ul>
                </nav>

                <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 col-lg-10 offset-lg-2 pt-3">
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
    <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @if($viewname === 'account')
        <script src="{{ asset('assets/js/chart_placeholder.js') }}"></script>

        <script src="{{ asset('assets/js/account_charts.js') }}"></script>

        <script src="{{ asset('assets/js/custom_tabs.js') }}"></script>

        <script src="{{ asset('assets/js/account_note.js') }}"></script>

    @elseif($viewname === 'device')

        <script src="{{ asset('assets/js/device_status.js') }}"></script>

        <script src="{{ asset('assets/js/custom_tabs.js') }}"></script>

        <script src="{{ asset('assets/js/device_charts.js') }}"></script>

    @elseif($viewname === 'Transactions' || $viewname === 'DataTables')

        <link href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        @stack('scripts')

    @elseif($viewname === 'ticket')

        <script src="{{ asset('assets/js/chart_placeholder.js') }}"></script>

        <script src="{{ asset('assets/js/account_charts.js') }}"></script>

        <script src="{{ asset('assets/js/custom_tabs.js') }}"></script>

        <script src="{{ asset('assets/js/account_note.js') }}"></script>


    @endif

    <script>
        (function(p,e,n,d,o){var v,w,x,y,z;o=p[d]=p[d]||{};o._q=[];
            v=['initialize','identify','updateOptions','pageLoad'];for(w=0,x=v.length;w<x;++w)(function(m){
                o[m]=o[m]||function(){o._q[m===v[0]?'unshift':'push']([m].concat([].slice.call(arguments,0)));};})(v[w]);
            y=e.createElement(n);y.async=!0;y.src='https://cdn.pendo.io/agent/static/00a9f372-c943-49d0-468a-e4e89d73262c/pendo.js';
            z=e.getElementsByTagName(n)[0];z.parentNode.insertBefore(y,z);})(window,document,'script','pendo');


        $.ajax({
            type: "GET",
            url: '/getAuthUser',
            success: function (data) {

                var user = data;

                if(user !== false){
                    // Call this whenever information about your visitors becomes available
                    // Please use Strings, Numbers, or Bools for value types.
                    pendo.initialize({
                        apiKey: '00a9f372-c943-49d0-468a-e4e89d73262c',

                        visitor: {
                            id:         user.id,
                            email:      user.email
                            // role:         // Optional

                            // You can add any additional visitor level key-values here,
                            // as long as it's not one of the above reserved names.
                        },

                        account: {
                             id:           user.id,
                             name:         user.email
                            // planLevel:    // Optional
                            // planPrice:    // Optional
                            // creationDate: // Optional

                            // You can add any additional account level key-values here,
                            // as long as it's not one of the above reserved names.
                        }
                    });
                }
            }
        });


    </script>


</body>
</html>
