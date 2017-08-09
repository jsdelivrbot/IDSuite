@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">
        {{--<div class="row">--}}
            {{--<div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">--}}
                {{--@if($number === 1)--}}

                    {{--<div class="card card-inverse card-square border-bottom-pink border-right-pink" style="border-top: none; border-left: none; background-color: transparent;">--}}
                        {{--<div class="card-block">--}}
                            {{--<h4 class="card-title pink">{{$ticket->subject}}</h4>--}}
                            {{--<p class="card-text text-white">This case is for customer {{$ticket->entity_name}}</p>--}}

                            {{--<div class="col-md-10 offset-1">--}}
                                {{--<div class="chart-container">--}}
                                    {{--<canvas id="myChart"></canvas>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                {{--@elseif($number === 2)--}}

                    {{--<div class="card card-inverse card-square border-bottom-teal border-right-teal" style="border-top: none; border-left: none; background-color: transparent; ">--}}
                        {{--<div class="card-block">--}}
                            {{--<h4 class="card-title teal">{{$ticket->subject}}</h4>--}}
                            {{--<p class="card-text text-white">This case is for customer {{$ticket->entity_name}}</p>--}}

                            {{--<div class="col-md-10 offset-1">--}}
                                {{--<div class="chart-container">--}}
                                    {{--<canvas id="myChart"></canvas>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                {{--@elseif($number === 3)--}}

                    {{--<div class="card card-inverse card-square border-bottom-purple border-right-purple" style="border-top: none; border-left: none; background-color: transparent;">--}}
                        {{--<div class="card-block">--}}
                            {{--<h4 class="card-title purple">{{$ticket->subject}}</h4>--}}
                            {{--<p class="card-text text-white">This case is for customer {{$ticket->entity_name}}</p>--}}

                            {{--<div class="col-md-10 offset-1">--}}
                                {{--<div class="chart-container">--}}
                                    {{--<canvas id="myChart"></canvas>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                {{--@elseif($number === 4)--}}

                    {{--<div class="card card-inverse card-square border-bottom-yellow border-right-yellow" style="border-top: none; border-left: none; background-color: transparent;">--}}
                        {{--<div class="card-block">--}}
                            {{--<h4 class="card-title yellow">{{$ticket->subject}}</h4>--}}
                            {{--<p class="card-text text-white">This case is for customer {{$ticket->entity_name}}</p>--}}

                            {{--<div class="col-md-10 offset-1">--}}
                                {{--<div class="chart-container">--}}
                                    {{--<canvas id="myChart"></canvas>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                {{--@else--}}

                    {{--<div class="card card-inverse card-square border-bottom-blue border-right-blue" style="border-top: none; border-left: none; background-color: transparent;">--}}
                        {{--<div class="card-block">--}}
                            {{--<h4 class="card-title blue">{{$ticket->subject}}</h4>--}}
                            {{--<p class="card-text text-white">This case is for customer {{$ticket->entity_name}}</p>--}}

                            {{--<div class="col-md-10 offset-1">--}}
                                {{--<div class="chart-container">--}}
                                    {{--<canvas id="myChart"></canvas>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-lg-12 mt-5 mb-4" style="padding: 0;">--}}
            {{--<div class="row no-gutters">--}}

                {{--<div class="col-lg-6">--}}
                    {{--<div id="container_two"></div>--}}
                {{--</div>--}}

                {{--<div class="col-lg-6">--}}
                    {{--<div id="container_one"></div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}

        <div class="row mt-4">
            <div class="col-12">
                @include('partials.custom_tabs.custom_tabs')
            </div>
        </div>
    </div>

@endsection