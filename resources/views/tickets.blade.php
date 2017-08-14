@extends('layouts.app')

@section('content')


    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">
            <h6 class="ml-lg-3 subtle-text" style="color: #c8cad5">SUPPORT</h6>
            <h3 class="ml-lg-3 raleway" style="color: white;">Cases</h3>
        </div>

        <div class="col-lg-10" style="color: white;">
            <div class="row">
                <div class="col-lg-10">
                    <div class="float-right">
                        <input type="search" placeholder="Search Filter..." name="search" class="form-control searchbox-input" required="">

                        <div class="form-check mt-2 mb-0">
                            <form action="/filter/tickets">
                                <label class="form-check-label mr-1">
                                    <input id="filter-all" name="filter" class="form-check-input" type="checkbox">
                                    All Cases
                                </label>
                                <button id="filter" type="submit" class="btn btn-primary btn-sm ml-5">Filter</button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="float-right raleway">
                        Qty: {{$page_tickets->total()}}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="col-lg-6 offset-3">
        <hr style="border-top: 2px solid rgba(255, 255, 255, 0.2) !important;">

        {{--<div id="container"></div>--}}

    </div>
    <section id="cards">

            @foreach($tickets as $ticket)



                @if($loop->index % 3 === 0 && !$loop->last)
                    <div class="row">
                @elseif($loop->last)

                @endif

                @php
                    $number = $ticket->status_type;

                    if(strlen($ticket->entity_name) > 23 ){
                        $trunc_name = substr($ticket->entity_name, 0, 20);

                        $trunc_name = $trunc_name . '...';

                    } else {
                        $trunc_name = $ticket->entity_name;
                    }

                @endphp

                    {{--<p class="text-white">{{$number}}</p>--}}

                @if($number === 4)

                    <div class="col-lg-4">
                        <div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 1)

                    <div class="col-lg-4">
                        <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="col-lg-4">
                        <div class="card mb-3 text-center" style="background-color: #9F86FF;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="col-lg-4">
                        <div class="card mb-3 text-center" style="background-color: #E4D836;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 0)

                    <div class="col-lg-4">
                        <div class="card mb-3 text-center" style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 6)

                    <div class="col-lg-4">
                        <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                @elseif($number === 7)

                    <div class="col-lg-4">
                        <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                            <div class="card-block">
                                <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                <p class="card-text">{{$ticket->entity_name}}</p>
                                <p class="card-text">{{$ticket->subject}}</p>
                                <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                    @elseif($number === 8)

                        <div class="col-lg-4">
                            <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                <div class="card-block">
                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                    <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                    <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                    <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                    <p class="card-text">{{$ticket->entity_name}}</p>
                                    <p class="card-text">{{$ticket->subject}}</p>
                                    <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
                                </div>
                            </div>
                        </div>

                    @elseif($number === 9)

                        <div class="col-lg-4">
                            <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                <div class="card-block">
                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>

                                    <div class="searchfilterterm" style="display: none;">{{strtolower($ticket->reference_id)}}</div>

                                    <p class="card-text">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                    <p class="card-text">{{intval(floor($ticket->duration/60/60/24))}} Day(s)</p>
                                    <p class="card-text">{{$ticket->entity_name}}</p>
                                    <p class="card-text">{{$ticket->subject}}</p>
                                    <a href="tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">Go somewhere</a>
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

        <div class="row">
            <div class="mx-auto">
                {{$page_tickets->links('partials.pagination.default')}}
            </div>
        </div>
    </section>

@endsection


@push('tickets')

<script>

    $('.searchbox-input').keypress( function () {

        $('.card').parent().show();

        let filter = $(this).val(); // get the value of the input, which we filter on

        $('#cards').find(".searchfilterterm:not(:contains(" + filter.toLowerCase() + "))").parent().parent().parent().css('display','none');
    });

//    $('#filter').click( function () {
//
//        console.log($('#filter-all').prop("checked"));
//
//        $.ajax({
//            url: '/filter/tickets',
//            type: 'GET',
//            data: {
//                isAll: $('#filter-all').prop("checked")
//            },
//            success: function(data){
//                console.log(data);
//            }
//        });
//
//    });

</script>

@endpush