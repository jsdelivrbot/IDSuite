@extends('layouts.app')

@section('content')


    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">
            <h6 class="ml-lg-3 subtle-text" style="color: #c8cad5">SALES</h6>
            <h3 class="ml-lg-3 raleway" style="color: white;">Accounts</h3>
        </div>

        <div class="col-lg-10" style="color: white;">
            <div class="row">
                <div class="col-lg-10">
                    <div class="float-right">
                        <input type="search" placeholder="Search Filter..." name="search" class="form-control searchbox-input" required="">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="float-right raleway">
                        Qty: {{count($accounts)}}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="col-lg-6 offset-3">
        <hr style="border-top: 2px solid rgba(255, 255, 255, 0.2) !important;">
    </div>
    <section id="cards">

        @foreach($accounts as $account)

            @if($loop->index % 3 === 0 && !$loop->last)
                <div class="row">
            @elseif($loop->last)
                <div class="row">
            @endif

                @php
                    $number = rand(1,5);

                    if(strlen($account->name) > 23 ){
                        $trunc_name = substr($account->name, 0, 20);

                        $trunc_name = $trunc_name . '...';

                    } else {
                        $trunc_name = $account->name;
                    }

                @endphp

                    @if($number === 1)

                            <div class="col-lg-4">
                            <div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                <div class="card-block">
                                    <h4 class="card-title text-truncate">{{$account->name}}</h4>
                                    <div class="searchfilterterm" style="display: none;">{{strtolower($account->name)}}</div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/measure/accounts/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a>
                                </div>
                            </div>
                                </div>


                    @elseif($number === 2)

                        <div class="col-lg-4">
                            <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                <div class="card-block">
                                    <h4 class="card-title text-truncate">{{$account->name}}</h4>
                                    <div class="searchfilterterm" style="display: none;">{{strtolower($account->name)}}</div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/measure/accounts/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a>
                                </div>
                            </div>
                        </div>


                    @elseif($number === 3)

                        <div class="col-lg-4">
                            <div class="card mb-3 text-center" style="background-color: #9F86FF;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                <div class="card-block">
                                    <h4 class="card-title text-truncate">{{$account->name}}</h4>
                                    <div class="searchfilterterm" style="display: none;">{{strtolower($account->name)}}</div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/measure/accounts/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a>
                                </div>
                            </div>
                        </div>


                    @elseif($number === 4)

                        <div class="col-lg-4">
                            <div class="card mb-3 text-center" style="background-color: #E4D836;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                <div class="card-block">
                                    <h4 class="card-title text-truncate">{{$account->name}}</h4>
                                    <div class="searchfilterterm" style="display: none;">{{strtolower($account->name)}}</div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/measure/accounts/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a>
                                </div>
                            </div>
                        </div>

                    @elseif($number === 5)

                        <div class="col-lg-4">
                            <div class="card mb-3 text-center" style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                <div class="card-block">
                                    <h4 class="card-title text-truncate">{{$account->name}}</h4>
                                    <div class="searchfilterterm" style="display: none;">{{strtolower($account->name)}}</div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/measure/accounts/{{$account->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a>
                                </div>
                            </div>
                        </div>


                    @endif

                @if($loop->iteration % 3 === 0)
                </div>
                @elseif($loop->last)
                </div>
                @endif

            @endforeach
    </section>

@endsection


@push('accounts')

<script>

    $('.searchbox-input').keypress( function () {

        $('.card').parent().show();

        let filter = $(this).val(); // get the value of the input, which we filter on

        $('#cards').find(".searchfilterterm:not(:contains(" + filter.toLowerCase() + "))").parent().parent().parent().css('display','none');
    });



</script>

@endpush