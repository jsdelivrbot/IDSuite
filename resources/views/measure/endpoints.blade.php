@extends('layouts.app')

@section('content')

    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">
            <h6 class="ml-lg-3 subtle-text" style="color: #c8cad5">Endpoints</h6>
            <h3 class="ml-lg-3 raleway" style="color: white;">Devices</h3>

            <a id="contact-submit" class="btn btn-nav-orange" style="cursor: pointer !important;"
               href="/measure/device/create"><i class="fa fa-plus"></i> Add Endpoint</a>

        </div>

        <div class="col-lg-10" style="color: white;">
            <div class="row">
                <div class="col-lg-10">
                    <div class="float-right">
                        <input type="search" placeholder="Search Filter..." name="search"
                               class="form-control searchbox-input" required="">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="float-right raleway" id="endpoints-count">

                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="col-lg-6 offset-3">

        <hr class="custom-hr">

    </div>

    <section id="cards">

        {{--@foreach($endpoints as $endpoint)--}}
            {{--@if($loop->index % 3 === 0 && !$loop->last)--}}
                {{--<div class="row">--}}
                    {{--@elseif($loop->last)--}}

                    {{--@endif--}}

                    {{--@php--}}
                        {{--$number = rand(1,5);--}}

                    {{--@endphp--}}

                    {{--@if($number === 1)--}}

                        {{--<div class="col-lg-4">--}}
                            {{--<div class="card mb-3 text-center"--}}
                                 {{--style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">--}}
                                {{--<div class="card-block">--}}
                                    {{--<h4 class="card-title text-truncate">{{$endpoint->name}}</h4>--}}
                                    {{--<div class="searchfilterterm"--}}
                                         {{--style="display: none;">{{strtolower($endpoint->name)}}</div>--}}
                                    {{--<p class="card-text">Some quick example text to build on the card title and make up--}}
                                        {{--the bulk of the card's content.</p>--}}
                                    {{--<a href="/measure/devices/{{$endpoint->id}}" class="btn btn-outline-secondary"--}}
                                       {{--style="color: white !important; border-color: white !important;">Go somewhere</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@elseif($number === 2)--}}

                        {{--<div class="col-lg-4">--}}
                            {{--<div class="card mb-3 text-center"--}}
                                 {{--style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">--}}
                                {{--<div class="card-block">--}}
                                    {{--<h4 class="card-title text-truncate">{{$endpoint->name}}</h4>--}}
                                    {{--<div class="searchfilterterm"--}}
                                         {{--style="display: none;">{{strtolower($endpoint->name)}}</div>--}}
                                    {{--<p class="card-text">Some quick example text to build on the card title and make up--}}
                                        {{--the bulk of the card's content.</p>--}}
                                    {{--<a href="/measure/devices/{{$endpoint->id}}" class="btn btn-outline-secondary"--}}
                                       {{--style="color: white !important; border-color: white !important;">Go somewhere</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@elseif($number === 3)--}}

                        {{--<div class="col-lg-4">--}}
                            {{--<div class="card mb-3 text-center"--}}
                                 {{--style="background-color: #9F86FF;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">--}}
                                {{--<div class="card-block">--}}
                                    {{--<h4 class="card-title text-truncate">{{$endpoint->name}}</h4>--}}
                                    {{--<div class="searchfilterterm"--}}
                                         {{--style="display: none;">{{strtolower($endpoint->name)}}</div>--}}
                                    {{--<p class="card-text">Some quick example text to build on the card title and make up--}}
                                        {{--the bulk of the card's content.</p>--}}
                                    {{--<a href="/measure/devices/{{$endpoint->id}}" class="btn btn-outline-secondary"--}}
                                       {{--style="color: white !important; border-color: white !important;">Go somewhere</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@elseif($number === 4)--}}

                        {{--<div class="col-lg-4">--}}
                            {{--<div class="card mb-3 text-center"--}}
                                 {{--style="background-color: #E4D836;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">--}}
                                {{--<div class="card-block">--}}
                                    {{--<h4 class="card-title text-truncate">{{$endpoint->name}}</h4>--}}
                                    {{--<div class="searchfilterterm"--}}
                                         {{--style="display: none;">{{strtolower($endpoint->name)}}</div>--}}
                                    {{--<p class="card-text">Some quick example text to build on the card title and make up--}}
                                        {{--the bulk of the card's content.</p>--}}
                                    {{--<a href="/measure/devices/{{$endpoint->id}}" class="btn btn-outline-secondary"--}}
                                       {{--style="color: white !important; border-color: white !important;">Go somewhere</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@elseif($number === 5)--}}

                        {{--<div class="col-lg-4">--}}
                            {{--<div class="card mb-3 text-center"--}}
                                 {{--style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">--}}
                                {{--<div class="card-block">--}}
                                    {{--<h4 class="card-title text-truncate">{{$endpoint->name}}</h4>--}}
                                    {{--<div class="searchfilterterm"--}}
                                         {{--style="display: none;">{{strtolower($endpoint->name)}}</div>--}}
                                    {{--<p class="card-text">Some quick example text to build on the card title and make up--}}
                                        {{--the bulk of the card's content.</p>--}}
                                    {{--<a href="/measure/devices/{{$endpoint->id}}" class="btn btn-outline-secondary"--}}
                                       {{--style="color: white !important; border-color: white !important;">Go somewhere</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--@if($loop->iteration % 3 === 0)--}}
                {{--</div>--}}
            {{--@elseif($loop->last)--}}

            {{--@endif--}}

        {{--@endforeach--}}

    </section>


@endsection


@push('devices')

    <script>

        /**
         *
         * getEndpoints
         *
         * returns all the entities objects to create the cards.
         *
         * @param user_id
         */
        function getEndpoints(user_id) {

            let options = JSON.stringify({
                id: user_id
            });

            return axios.get('/api/endpoints/' + options)
                .then(function (response) {

                    console.log(response);

                    let endpoints = response.data;

                    if(!validate(endpoints)){
                        return false;
                    }

                    if (endpoints.length > 0) {
                        setQuantity(endpoints, $('#endpoints-count'));
                        createCards(endpoints, '/measure/devices/');
                    } else {
                        alert('Hello {{Auth::user()->contact->name->first_name}} you don\'t seem to have any accounts to manage.');
                    }
                });
        }


        $(document).ready(function () {
            axiosrequests.push = getEndpoints('{{Auth::user()->id}}');
            initSearchBox($('.searchbox-input'), $('#cards'));
        });

    </script>

@endpush