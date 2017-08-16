@if(strpos(request()->getQueryString(), 'page' ) !== false)
    <div class="tab-pane card-block active active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
@else
    <div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
@endif

        @if(count($page_tickets) === 0)

                <h4 class="card-title text-white">Cases</h4>

                <p class="card-text text-white">We currently do not have any cases associated with this account.</p>

        @else



                <h4 class="card-title color-{{$tab_count}}">Cases<span class="float-right">Qty: {{$page_tickets->total()}}</span></h4>



                <div class="card-deck">

                        @foreach($page_tickets as $ticket)

                                @php
                                    $number = $ticket->status_type;
                                @endphp


                                @if($number === 4)

                                        <div class="col-lg-4 p-lg-3">
                                            <div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                                <div class="card-block">
                                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6">
                                                            <p class="card-text text-capitalize font-weight-bold">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="card-text">{{intval(floor($ticket->duration()/60/60/24))}} Day(s)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        {{--<p class="card-text">{{$ticket->entity->contact->name->name}}</p>--}}
                                                        <div class="col-lg-12">
                                                            <p class="card-text text-left">{{$ticket->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                            <a href="/tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @elseif($number === 1)

                                        <div class="col-lg-4 p-lg-3">
                                            <div class="card mb-3 text-center" style="background-color: #E64759;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                                <div class="card-block">
                                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6">
                                                            <p class="card-text text-capitalize font-weight-bold">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="card-text">{{intval(floor($ticket->duration()/60/60/24))}} Day(s)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        {{--<p class="card-text">{{$ticket->entity->contact->name->name}}</p>--}}
                                                        <div class="col-lg-12">
                                                            <p class="card-text text-left">{{$ticket->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                            <a href="/tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @elseif($number === 2)

                                        <div class="col-lg-4 p-lg-3">
                                            <div class="card mb-3 text-center" style="background-color: #9F86FF;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                                <div class="card-block">
                                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6">
                                                            <p class="card-text text-capitalize font-weight-bold">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="card-text">{{intval(floor($ticket->duration()/60/60/24))}} Day(s)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        {{--<p class="card-text">{{$ticket->entity->contact->name->name}}</p>--}}
                                                        <div class="col-lg-12">
                                                            <p class="card-text text-left">{{$ticket->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                            <a href="/tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @elseif($number === 3)

                                        <div class="col-lg-4 p-lg-3">
                                            <div class="card mb-3 text-center" style="background-color: #E4D836;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                                <div class="card-block">
                                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6">
                                                            <p class="card-text text-capitalize font-weight-bold">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="card-text">{{intval(floor($ticket->duration()/60/60/24))}} Day(s)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        {{--<p class="card-text">{{$ticket->entity->contact->name->name}}</p>--}}
                                                        <div class="col-lg-12">
                                                            <p class="card-text text-left">{{$ticket->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                            <a href="/tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @elseif($number === 0)

                                        <div class="col-lg-4 p-lg-3">
                                            <div class="card mb-3 text-center" style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                                <div class="card-block">
                                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6">
                                                            <p class="card-text text-capitalize font-weight-bold">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="card-text">{{intval(floor($ticket->duration()/60/60/24))}} Day(s)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        {{--<p class="card-text">{{$ticket->entity->contact->name->name}}</p>--}}
                                                        <div class="col-lg-12">
                                                            <p class="card-text text-left">{{$ticket->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                            <a href="/tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @elseif($number === 5)

                                        <div class="col-lg-4 p-lg-3">
                                            <div class="card mb-3 text-center" style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                                <div class="card-block">
                                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6">
                                                            <p class="card-text text-capitalize font-weight-bold">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="card-text">{{intval(floor($ticket->duration()/60/60/24))}} Day(s)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        {{--<p class="card-text">{{$ticket->entity->contact->name->name}}</p>--}}
                                                        <div class="col-lg-12">
                                                            <p class="card-text text-left">{{$ticket->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                            <a href="/tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @elseif($number === 6)

                                        <div class="col-lg-4 p-lg-3">
                                            <div class="card mb-3 text-center" style="background-color: #1ca8dd;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">
                                                <div class="card-block">
                                                    <h4 class="card-title text-truncate">{{$ticket->reference_id}}</h4>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6">
                                                            <p class="card-text text-capitalize font-weight-bold">{{\App\Enums\EnumTicketStatusType::getValueByKey($ticket->status_type)}}</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="card-text">{{intval(floor($ticket->duration()/60/60/24))}} Day(s)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        {{--<p class="card-text">{{$ticket->entity->contact->name->name}}</p>--}}
                                                        <div class="col-lg-12">
                                                            <p class="card-text text-left">{{$ticket->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12">
                                                                <a href="/tickets/{{$ticket->id}}" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Case</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @endif

                        @endforeach


                </div>

        <div class="row">
            <div class="mx-auto">
                {{$page_tickets->links('partials.pagination.case')}}
            </div>
        </div>
        @endif
</div>