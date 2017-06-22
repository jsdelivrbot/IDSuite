@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">
                @php
                    $number = rand(1,5);
                @endphp
                @if($number === 1)

                    <div class="card card-inverse card-square border-bottom-pink border-right-pink" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title pink">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <div class="chart-container">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="card card-inverse card-square border-bottom-teal border-right-teal" style="border-top: none; border-left: none; background-color: transparent; ">
                        <div class="card-block">
                            <h4 class="card-title teal">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <div class="chart-container">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="card card-inverse card-square border-bottom-purple border-right-purple" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title purple">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <div class="chart-container">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>

                @elseif($number === 4)

                    <div class="card card-inverse card-square border-bottom-yellow border-right-yellow" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title yellow">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <div class="chart-container">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>

                @else

                    <div class="card card-inverse card-square border-bottom-blue border-right-blue" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">
                            <h4 class="card-title blue">{{$name}}</h4>
                            <p class="card-text text-white">This is customer {{$name}}</p>

                            <div class="col-md-10 offset-1">
                                <div class="chart-container">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>

                @endif
            </div>
        </div>

        <div class="col-lg-4 offset-4">
            <hr class="mt-5" style="border-color: rgba(255, 255, 255, 0.2);">
        </div>

        <div class="card card-square mb-lg-5" style="background-color: transparent; border: none; height: 400px;">
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