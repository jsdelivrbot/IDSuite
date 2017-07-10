@extends('layouts.app')

@section('content')

    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">
            <h6 class="ml-lg-3 subtle-text" style="color: #434857">DEVICE RECORDS</h6>
            <h3 class="ml-lg-3 raleway" style="color: white;">Transactions</h3>
        </div>

        <div class="col-lg-10" style="color: white;">
            <div class="float-right raleway mt-4">
                {{--Qty: {{count($records)}}--}}
            </div>
        </div>

    </section>
    <div class="col-lg-6 offset-3">
        <hr style="border-top: 2px solid rgba(255, 255, 255, 0.2) !important;">
    </div>

    @include('datatables.recordtable')

@endsection

