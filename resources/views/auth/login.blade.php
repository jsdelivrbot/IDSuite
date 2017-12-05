@extends('layouts.app')

@section('content')
<div class="container mt-lg-5">
    <div class="row">
        @if (auth::guest() && $viewname === 'Login')
        <div class="col-lg-5 col-xs-12 offset-lg-10">
            <div class="card text-white" style="background-color: rgba(67,72,87,0.7); border-color: rgba(255, 255, 255, 0.2); ">
                <div class="card-header text-center" style="background-color: rgba(67,72,87,0.7); border-color: rgba(255, 255, 255, 0.2); ">
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
                    <h3 class="text-center" >IDSuite</h3>
                </div>
                <div class="card-block pb-0">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="col-md-12 col-sm-10">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">E-Mail Address</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-6 offset-3">
                                    <button type="submit" class="btn btn-block btn-nav-teal">Login</button>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <a class="btn btn-link float-left" style="color: white;" href="{{ route('password.request') }}">
                                        Password Reset
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <a class="btn btn-link float-right" style="color: white;" href="{{ route('password.request') }}">
                                        Request Access
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
            <div class="col-lg-10 offset-1">
                <div class="card card-inverse" style="background-color: #434857; border-color: rgba(255, 255, 255, 0.2); ">
                    <h3 class="card-header" style="background-color: #434857;">Login</h3>
                    <div class="card-block">
                        <p class="card-text">Hey you are home.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<video id="bgvid" playsinline preload autoplay muted loop>
    <source src="http://192.35.252.40/img/login_video.m4v" type="video/mp4">
</video>

    <style>
        video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -100;
            transform: translateX(-50%) translateY(-50%);
            background-size: cover;
            transition: 1s opacity;
        }

        @media screen and (max-width: 500px) {
            div{width:70%;}
        }
        @media screen and (max-device-width: 800px) {
            html { background: url(https://thenewcode.com/assets/images/polina.jpg) #000 no-repeat center center fixed; }
            #bgvid { display: none; }
        }
    </style>

    <script>

        let vid = document.getElementById("bgvid");

        if (window.matchMedia('(prefers-reduced-motion)').matches) {
            vid.removeAttribute("autoplay");
            vid.pause();
            pauseButton.innerHTML = "Paused";
        }

        function vidFade() {
            vid.classList.add("stopfade");
        }

        vid.addEventListener('ended', function()
        {
            // only functional if "loop" is removed
            vid.pause();
            // to capture IE10
            vidFade();
        });
    </script>
@endsection
