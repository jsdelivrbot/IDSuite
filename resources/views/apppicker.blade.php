@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">

        <div class="row">

            <div class="card-deck">
            {{--<div class="col-lg-4 col-md-4 offset-md-2 offset-lg-0">--}}
                <div class="card" style="background-color: #1BC98E;color: #252830 !important;">
                    <div class="card-block text-right">
                        <h4 class="card-title">SMRGE</h4>
                        <p class="card-text text-nowrap">This is our business intelligence application.</p>
                        <a href="accounts" class="btn btn-outline-pink float-right" style="color: white !important; border-color: white !important;">Launch</a>
                    </div>
                </div>
            {{--</div>--}}

            {{--<div class="col-lg-4 col-md-4 offset-md-2 offset-lg-0">--}}
                <div class="card" style="background-color: #E64759;color: #252830;">
                    <div class="card-block text-right">
                        <h4 class="card-title">MedSitter</h4>
                        <p class="card-text">This is our patient observation application.</p>
                        <a href="accounts" class="btn btn-outline-blue float-right disabled" style="color: white !important; border-color: white !important;"><i class="fa fa-lock" aria-hidden="true" style="color: white !important;"></i>&nbsp Launch</a>
                    </div>
                </div>
            {{--</div>--}}

            {{--<div class="col-lg-4 col-md-4 offset-md-2 offset-lg-0">--}}
                <div class="card" style="background-color: #9F86FF;color: #252830 !important;">
                    <div class="card-block text-right">
                        <h4 class="card-title">Trust Partner Portal</h4>
                        <p class="card-text">This is our patient observation application.</p>
                        <a href="accounts" class="btn btn-outline-teal float-right disabled" style="color: white !important; border-color: white !important;"><i class="fa fa-lock" aria-hidden="true" style="color: white !important;"></i>&nbsp Launch</a>
                    </div>
                </div>
            {{--</div>--}}

            </div>

        </div>

    </div>

@endsection