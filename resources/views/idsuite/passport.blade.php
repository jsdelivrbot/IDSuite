@extends('layouts.app')

@section('content')
    <div class="container p-lg-1" id="app">

        <passport-clients></passport-clients>

        <passport-authorized-clients></passport-authorized-clients>

        <passport-personal-access-tokens></passport-personal-access-tokens>

    </div>
@endsection