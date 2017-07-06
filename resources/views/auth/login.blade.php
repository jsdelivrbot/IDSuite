@extends('layouts.app')

@section('content')
<div class="container mt-lg-5">
    <div class="row">
        @if (auth::guest() && $viewname === 'Login')
        <div class="col-lg-10 offset-1">
            <div class="card card-inverse" style="background-color: #434857; border-color: rgba(255, 255, 255, 0.2); ">
                <h3 class="card-header" style="background-color: #434857;">Login</h3>
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

                                <button type="submit" class="btn" style="background-color: #5cb85c">
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
    </div>
</div>
@endsection
