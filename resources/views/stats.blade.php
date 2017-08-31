@extends('layouts.app')

@section('content')


    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">
            <h6 class="ml-lg-3 subtle-text" style="color: #c8cad5">STATISTICS</h6>
            <h3 class="ml-lg-3 raleway" style="color: white;">Product</h3>
        </div>

    </section>

    <div class="col-lg-6 offset-3">
        <hr style="border-top: 2px solid rgba(255, 255, 255, 0.2) !important;">
    </div>

    <section class="mb-lg-2 mt-lg-4">
        <div class="card-deck">
            <div class="card card-purple">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Customer Count</h4>
                        <h1 class="card-title">{{$customer_count}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-orange">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Zabbix count</h4>
                        <h1 class="card-title">{{$zabbix_count}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-pink">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">NetSuite Count</h4>
                        <h1 class="card-title">{{$netsuite_count}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-yellow">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Mrge Count</h4>
                        <h1 class="card-title">{{$mrge_count}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-teal">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Polycom Count</h4>
                        <h1 class="card-title">{{$polycom_count}}</h1>
                    </div>
                </div>
            </div>

        </div>

    </section>


@endsection