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

        <div class="card card-square mb-lg-5" style="background-color: transparent; border: none;">
            <ul id="account-card-header" class="nav nav-tabs active-outline-card-header-pink" role="tablist">
                <li id="insights" class="nav-item">
                    <a id="insights-a" class="nav-link active-outline-tab-pink text-white" data-toggle="tab" href="#account-card-block-insights-tab" role="tab">Insights</a>
                </li>
                <li id="locations" class="nav-item">
                    <a id="locations-a" class="nav-link teal" data-toggle="tab" href="#account-card-block-locations-tab" role="tab">Locations</a>
                </li>
                <li id="contacts" class="nav-item">
                    <a id="contacts-a" class="nav-link blue" data-toggle="tab" href="#account-card-block-contacts-tab" role="tab">Contacts</a>
                </li>
                <li id="notes" class="nav-item">
                    <a id="notes-a" class="nav-link yellow" data-toggle="tab" href="#account-card-block-notes-tab" role="tab">Notes</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane card-block active active-outline-card-block-pink" id="account-card-block-insights-tab" role="tabpanel">
                    <h4 class="card-title text-white">Special title treatment</h4>
                    <p class="card-text text-white">With supporting text below as a natural lead-in to additional content.</p>
                    <a id="account-card-block-a" href="#" class="btn btn-nav-pink ">Go somewhere</a>
                </div>
                <div class="tab-pane card-block active-outline-card-block-teal" id="account-card-block-locations-tab" role="tabpanel">

                    <h3 class="card-title teal mb-3">Sites</h3>

                    @foreach($sites as $s)

                            <h5 class="card-title mt-2 text-white">{{$s->name}}</h5>
                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-6 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-4">Email</div>
                                        <div class="col-lg-8">{{$s->email}}</div>
                                        <div class="col-lg-4">Phone Number</div>
                                        <div class="col-lg-8">{{$s->number}}</div>
                                        <div class="col-lg-4">Address</div>
                                        <div class="col-lg-8">{{$s->address}}</div>
                                        <div class="col-lg-4">City</div>
                                        <div class="col-lg-8">{{$s->city}}</div>
                                        <div class="col-lg-4">State</div>
                                        <div class="col-lg-8">{{$s->state}}</div>
                                        <div class="col-lg-4">Postal Code</div>
                                        <div class="col-lg-8">{{$s->zip}}</div>
                                    </li>
                                </ul>
                            </div>

                    @if(!$loop->last)
                        <hr class="mb-4" style="border-color: #1BC98E">
                    @endif
                    @endforeach
                </div>

                <div class="tab-pane card-block active-outline-card-block-blue" id="account-card-block-contacts-tab" role="tabpanel">

                    @if(count($persons) === 0)

                        <h4 class="card-title text-white">Hrm...</h4>

                        <p class="card-text text-white">We currentyl do not have any contacts associated with this account.</p>
                        <a id="account-card-block-a" href="#" class="btn btn-nav-blue ">Add one.</a>

                    @endif

                    @foreach($persons as $p)



                    @endforeach
                </div>


                <div class="tab-pane card-block active-outline-card-block-yellow" id="account-card-block-notes-tab" role="tabpanel">

                    @if(count($persons) === 0)

                        <h4 class="card-title text-white">Hrm...</h4>

                        <p class="card-text text-white">We currentyl do not have any notes associated with this account.</p>
                        <a id="account-card-block-a" href="#" class="btn btn-nav-yellow ">Add one.</a>

                    @endif

                    @foreach($persons as $p)



                    @endforeach
                </div>

            </div>


        </div>

    </div>

@endsection