@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">
                <div class="card card-inverse card-square" style="background-color: transparent;border-bottom-width: 2px; border-bottom-color: rgba(255, 255, 255, 0.2); border-right-width: 2px; border-right-color: rgba(255, 255, 255, 0.2); border-top: none; border-left: none; height: 300px;">
                    <div class="card-block">
                        <h4 class="card-title">{{$name}}</h4>
                        <p class="card-text">This is customer {{$name}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 offset-4">
            <hr class="mt-5" style="border-color: rgba(255, 255, 255, 0.2);">
        </div>

        {{--<div class="row mt-lg-5">--}}
            {{--<div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">--}}
                {{--<div class="card card-inverse card-square" style="background-color: transparent;border-top-width: 2px; border-top-color: rgba(255, 255, 255, 0.2); border-left-width: 2px; border-left-color: rgba(255, 255, 255, 0.2); border-bottom: none; border-right: none; height: 300px;">--}}
                    {{--<div class="card-block">--}}
                        {{--<h4 class="card-title"></h4>--}}
                        {{--<p class="card-text">This is customer {{$name}}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="card card-square" style="background-color: transparent; border: none; height: 400px;">
            <div id="account-card-header" class="card-header active-outline-card-header-pink" style="background-color: transparent;">
                <ul class="nav nav-tabs card-header-tabs">
                    <li id="insights" class="nav-item">
                        <a id="insights-a" class="nav-link active active-outline-tab-pink text-white" href="#">Insights</a>
                    </li>
                    <li id="locations" class="nav-item">
                        <a id="locations-a" class="nav-link teal" href="#">Locations</a>
                    </li>
                    <li id="contacts" class="nav-item">
                        <a id="contacts-a" class="nav-link blue" href="#">Contacts</a>
                    </li>
                </ul>
            </div>
            <div id="account-card-block" class="card-block active-outline-card-block-pink">
                <h4 class="card-title text-white">Special title treatment</h4>
                <p class="card-text text-white">With supporting text below as a natural lead-in to additional content.</p>
                <a id="account-card-block-a" href="#" class="btn btn-nav-pink ">Go somewhere</a>
            </div>
        </div>

    </div>

@endsection