@extends('layouts.app')

@section('content')


            <section class="row">

                <div class="col-lg-2">
                    <h6 class="ml-lg-3 subtle-text" style="color: #434857">SALES</h6>
                    <h3 class="ml-lg-3 raleway" style="color: white;">Accounts</h3>
                </div>
                <div class="col-lg-10" style="color: white;">
                    <div class="float-right raleway mt-4">
                        Qty: {{count($accounts)}}
                    </div>
                </div>
            </section>

            <section class="row">

            @foreach($accounts as $account)

                @php
                $number = rand(1,5)
                @endphp

                @if($number === 1)
                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center card-square" style="background-color: #1BC98E;color: #252830 !important;">
                            <div class="card-block">
                                <h4 class="card-title ">{{$account->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="account/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 2)
                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center card-square" style="background-color: #E64759;color: #252830 !important;">
                            <div class="card-block">
                                <h4 class="card-title ">{{$account->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="account/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @elseif($number === 3)
                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center card-square" style="background-color: #9F86FF;color: #252830 !important;">
                            <div class="card-block">
                                <h4 class="card-title ">{{$account->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="account/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @elseif($number === 4)
                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center card-square" style="background-color: #E4D836;color: #252830 !important;">
                            <div class="card-block">
                                <h4 class="card-title ">{{$account->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="account/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @elseif($number === 5)
                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center card-square" style="background-color: #1ca8dd;color: #252830 !important;">
                            <div class="card-block">
                                <h4 class="card-title ">{{$account->name}}</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="account/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach

            </section>
@endsection