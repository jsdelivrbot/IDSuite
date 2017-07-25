@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">
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

        <div class="col-lg-12 mt-5 mb-4" style="padding: 0;">
            {{--<hr class="mt-5" style="border-color: rgba(255, 255, 255, 0.2);">--}}
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div id="container_two"></div>
                </div>

                <div class="col-lg-6">
                    <div id="container_one"></div>
                </div>
            </div>
        </div>

        @include('partials.custom_tabs.custom_tabs');

    </div>

@endsection


@push('account_scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

<script>
    /**
     * Created by amac on 6/24/17.
     */

    $( document ).ready(function() {
        $.ajax({
            type: "GET",
            url: '/getRandomNumber',
            success: function (number) {

                let bgcolor;
                let bordercolor;

                let ctx = document.getElementById("myChart").getContext('2d');

                switch(number){
                    case '1' :
                        bgcolor = 'rgba(230, 71, 89, .2)';
                        bordercolor = 'rgba(230, 71, 89, 1)';
                        break;

                    case '2' :
                        bgcolor = 'rgba(27, 201, 142, .2)';
                        bordercolor = 'rgba(27, 201, 142, 1)';
                        break;

                    case '3' :
                        bgcolor = 'rgba(159, 134, 255, .2)';
                        bordercolor = 'rgba(159, 134, 255, 1)';
                        break;

                    case '4' :
                        bgcolor = 'rgba(228, 216, 54, .2)';
                        bordercolor = 'rgba(228, 216, 54, 1)';
                        break;

                    case '5' :
                        bgcolor = 'rgba(28, 168, 221, .2)';
                        bordercolor = 'rgba(28, 168, 221, 1)';
                        break;
                }

                let myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                bgcolor,
                            ],
                            borderColor: [
                                bordercolor,
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }
        });
    });
</script>

@endpush