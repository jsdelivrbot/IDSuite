{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Register</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="first-name" class="col-md-4 control-label">First Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="first-name" type="text" class="form-control" name="first-name" value="{{ old('first-name') }}" required autofocus>--}}

                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('first-name') }}</strong>--}}
                                {{--</span>--}}
                            {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('middle-name') ? ' has-error' : '' }}">--}}
                            {{--<label for="middle-name" class="col-md-4 control-label">Middle Name</label>Z--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="middle-name" type="text" class="form-control" name="middle-name" value="{{ old('middle-name') }}" required autofocus>--}}

                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('middle-name') }}</strong>--}}
                                {{--</span>--}}
                            {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('last-name') ? ' has-error' : '' }}">--}}
                            {{--<label for="last-name" class="col-md-4 control-label">Last Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="last-name" type="text" class="form-control" name="last-name" value="{{ old('last-name') }}" required autofocus>--}}

                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('last-name') }}</strong>--}}
                                {{--</span>--}}
                            {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('preferred-name') ? ' has-error' : '' }}">--}}
                            {{--<label for="preferred-name" class="col-md-4 control-label">Preferred Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="preferred-name" type="text" class="form-control" name="preferred-name" value="{{ old('preferred-name') }}" required autofocus>--}}

                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('preferred-name') }}</strong>--}}
                                {{--</span>--}}
                            {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="title" class="col-md-4 control-label">Title</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<select id="title" class="form-control">--}}
                                    {{--<option value="">Select a Title...</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="gender" class="col-md-4 control-label">Gender</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<select id="gender" class="form-control">--}}
                                    {{--<option value="">Select a Gender...</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}


                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first-name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="first-name" value="{{ old('first-name') }}">

                                    @if ($errors->has('first-name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first-name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('middle-name') ? ' has-error' : '' }}">
                                <label for="middle-name" class="col-md-4 control-label">Middle Name</label>

                                <div class="col-md-6">
                                    <input id="middle-name" type="text" class="form-control" name="middle-name" value="{{ old('middle-name') }}" required autofocus>

                                    <span class="help-block">
                                    <strong>{{ $errors->first('middle-name') }}</strong>
                                </span>
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('last-name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="last-name" value="{{ old('last-name') }}">

                                    @if ($errors->has('last-name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last-name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('preferred-name') ? ' has-error' : '' }}">
                                <label for="preferred-name" class="col-md-4 control-label">Preferred Name</label>

                                <div class="col-md-6">
                                    <input id="preferred-name" type="text" class="form-control" name="preferred-name" value="{{ old('preferred-name') }}" required autofocus>

                                    <span class="help-block">
                                    <strong>{{ $errors->first('preferred-name') }}</strong>
                                </span>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Title</label>
                                <div class="col-md-6">
                                    <select id="title" class="form-control" name="title">
                                        <option value="">Select a Title...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-4 control-label">Gender</label>
                                <div class="col-md-6">
                                    <select id="gender" class="form-control" name="gender">
                                        <option value="">Select a Gender...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Street Address</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">City</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}">

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">State</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="state" value="{{ old('state') }}">

                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Zip Code</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="zip" value="{{ old('zip') }}">

                                    @if ($errors->has('zip'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection