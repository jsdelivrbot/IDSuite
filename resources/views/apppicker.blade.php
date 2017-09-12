@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">

        <div class="card-deck mt-4">

            <div class="card" style="background-color: #1BC98E;color: #252830 !important;">
                <div class="card-block text-right">
                    <h4 class="card-title">MEASURE</h4>
                    <p class="card-text">Customer account performance analysis and insights.</p>
                    <a href="accounts" class="btn btn-outline-pink float-right" style="color: white !important; border-color: white !important;">Launch</a>
                </div>
            </div>

            <div class="card" style="background-color: #E64759;color: #252830;">
                <div class="card-block text-right">
                    <h4 class="card-title">LENS</h4>
                    <p class="card-text">Customer sentiment and perspective monitoring.</p>
                    <a href="accounts" class="btn btn-outline-blue float-right disabled" style="color: white !important; border-color: white !important;"><i class="fa fa-lock" aria-hidden="true" style="color: white !important;"></i>&nbsp Launch</a>
                </div>
            </div>

            <div class="card" style="background-color: #d59043;color: #252830 !important;">
                <div class="card-block text-right">
                    <h4 class="card-title">CASE</h4>
                    <p class="card-text">Details, insights, and analysis of customer support tickets.</p>
                    <a href="accounts" class="btn btn-outline-blue float-right disabled" style="color: white !important; border-color: white !important;"><i class="fa fa-lock" aria-hidden="true" style="color: white !important;"></i>&nbsp Launch</a>
                </div>
            </div>

        </div>
        <div class="card-deck mt-4">

                <div class="card" style="background-color: #9F86FF;color: #252830 !important;">
                    <div class="card-block text-right">
                        <h4 class="card-title">TRUST</h4>
                        <p class="card-text">Market and customer analysis collaboratively cultivated with trusted partners.</p>
                        <a href="/trust" class="btn btn-outline-teal float-right" style="color: white !important; border-color: white !important;">Launch</a>
                    </div>
                </div>


                <div class="card" style="background-color: #E4D836;color: #252830;">
                    <div class="card-block text-right">
                        <h4 class="card-title">MedSitter</h4>
                        <p class="card-text">Remote patient monitoring application.</p>
                        <a href="/medsitter" class="btn btn-outline-blue float-right" style="color: white !important; border-color: white !important;">Launch</a>
                    </div>
                </div>


                <div class="card" style="background-color: #1ca8dd;color: #252830;">
                    <div class="card-block text-right">
                        <h4 class="card-title">WebStore</h4>
                        <p class="card-text">Webstore - IDS eCommerce front-end.</p>
                        <a href="accounts" class="btn btn-outline-blue float-right disabled" style="color: white !important; border-color: white !important;"><i class="fa fa-lock" aria-hidden="true" style="color: white !important;"></i>&nbsp Launch</a>
                    </div>
                </div>

        </div>

    </div>
@endsection