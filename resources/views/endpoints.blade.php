@extends('layouts.app')

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row">--}}

                {{--<div class="col-lg-4" style="margin-top: 15px;">--}}
                    {{--<div class="card" style="width: 20rem;">--}}
                        {{--<div class="card-block">--}}
                            {{--<h4 class="card-title">{{$endpoint->name}}</h4>--}}
                            {{--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                            {{--<a href="account/{{$endpoint->id}}" class="btn btn-primary">Go somewhere</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">
            <h6 class="ml-lg-3 subtle-text" style="color: #c8cad5">Endpoints</h6>
            <h3 class="ml-lg-3 raleway" style="color: white;">Devices</h3>
        </div>

        <div class="col-lg-10" style="color: white;">
            <div class="float-right raleway mt-4">
                Qty: {{count($endpoints)}}
            </div>
        </div>

    </section>
    <div class="col-lg-6 offset-3">
        <hr style="border-top: 2px solid rgba(255, 255, 255, 0.2) !important;">

        {{--<div id="container"></div>--}}

    </div>
    <section class="row">

        <div class="card-deck">

            @foreach($endpoints as $endpoint)

                @php
                    $number = rand(1,5);
/*
                    if(strlen($endpoint->name) > 23 ){
                        $trunc_name = substr($endpoint->name, 0, 20);

                        $trunc_name = $trunc_name . '...';

                    } else {
                        $trunc_name = $endpoint->name;
                    }*/

                @endphp

                @if($number === 1)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                {{--<h4 class="card-title">{{$account->name}}</h4>--}}
                                <h4 class="card-title text-truncate">{{$endpoint->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="devices/{{$endpoint->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                {{--<h4 class="card-title ">{{$account->name}}</h4>--}}
                                <h4 class="card-title text-truncate">{{$endpoint->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="devices/{{$endpoint->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #9F86FF;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                {{--<h4 class="card-title ">{{$account->name}}</h4>--}}
                                <h4 class="card-title text-truncate">{{$endpoint->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="devices/{{$endpoint->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 4)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #E4D836;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                {{--<h4 class="card-title ">{{$account->name}}</h4>--}}
                                <h4 class="card-title text-truncate">{{$endpoint->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="devices/{{$endpoint->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 5)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                {{--<h4 class="card-title ">{{$account->name}}</h4>--}}
                                <h4 class="card-title text-truncate">{{$endpoint->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="devices/{{$endpoint->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @endif

            @endforeach

        </div>

    </section>


@endsection