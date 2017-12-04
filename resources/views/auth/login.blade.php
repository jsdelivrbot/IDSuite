@extends('layouts.app')

@section('content')
<div class="container mt-lg-5">
    <div class="row">
        @if (auth::guest() && $viewname === 'Login')
        <div class="col-lg-5 col-xs-1 offset-10">
            <div class="card card-inverse" style="background-color: #434857; border-color: rgba(255, 255, 255, 0.2); ">
                <h3 class="card-header" style="background-color: #434857;">IDSuite</h3>
                <div class="card-block">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="col-md-8 col-sm-10 offset-md-2">
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

                                <button type="submit" class="btn btn-nav-teal" >
                                    Login
                                </button>

                                <a class="btn btn-link" style="color: white;" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>

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
<video poster="http://idsuite.dev/img/login_background.mp4" id="bgvid" playsinline autoplay muted loop>
<source src="http://idsuite.dev/img/login_background.mp4" type="video/mp4">
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
