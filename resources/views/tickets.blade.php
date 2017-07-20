@extends('layouts.app')

@section('content')


    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">
            <h6 class="ml-lg-3 subtle-text" style="color: #434857">SUPPORT</h6>
            <h3 class="ml-lg-3 raleway" style="color: white;">Cases</h3>
        </div>

        <div class="col-lg-10" style="color: white;">
            <div class="float-right raleway mt-4">
                Qty: {{count($tickets)}}
            </div>
        </div>

    </section>
    <div class="col-lg-6 offset-3">
        <hr style="border-top: 2px solid rgba(255, 255, 255, 0.2) !important;">

        {{--<div id="container"></div>--}}

    </div>
    <section class="row">

        <div class="card-deck">

            @foreach($tickets as $ticket)

                @php
                    $number = $ticket->status_type;

                    if(strlen($ticket->entity_name) > 23 ){
                        $trunc_name = substr($ticket->entity_name, 0, 20);

                        $trunc_name = $trunc_name . '...';

                    } else {
                        $trunc_name = $ticket->entity_name;
                    }

                @endphp

                @if($number === 4)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 1)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #9F86FF;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #E4D836;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 0)

                    <div class="col-lg-3 p-lg-3">
                        <div class="card mb-3 text-center" style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @endif

            @endforeach

        </div>

    </section>

@endsection