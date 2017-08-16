@extends('layouts.app')

@section('content')


    <div class="row mt-5">
        <div class="col-12">
            <iframe id="iframe" width="100%" height="700px" title="Hospital General Information" src="https://data.medicare.gov/w/xubh-q36u/sn79-52w5?cur=HoY5rF0SREZ&from=root" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>


@endsection

@push('trust')


    <script>

        let iframe = document.getElementById('iframe');

        iframe.addEventListener("load", function(){

            $(".headerBar").hide();

            console.log($(".headerBar .clearfix"));

            console.log('done');

        });

    </script>


@endpush