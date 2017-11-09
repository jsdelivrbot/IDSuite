<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">
    <h3 class="card-title color-{{$tab_count}} mb-3">Sites</h3>

    @foreach($entity->sites as $s)

        <h5 class="card-title mt-2 text-white">{{$s->name}}</h5>
        <div class="card-text text-white">
            <ul class="list-group row" style="background-color: transparent;">
                <li class="col-lg-6 list-group-item" style="background-color: transparent; border: none;">
                    <div class="col-lg-4">Email</div>
                    <div class="col-lg-8">{{$s->email}}</div>
                    <div class="col-lg-4">Phone Number</div>
                    <div class="col-lg-8">{{$s->number}}</div>
                    <div class="col-lg-4">Address</div>
                    <div class="col-lg-8">{{$s->address}}</div>
                    <div class="col-lg-4">City</div>
                    <div class="col-lg-8">{{$s->city}}</div>
                    <div class="col-lg-4">State</div>
                    <div class="col-lg-8">{{$s->state}}</div>
                    <div class="col-lg-4">Postal Code</div>
                    <div class="col-lg-8">{{$s->zip}}</div>
                </li>
            </ul>
        </div>

        @if(!$loop->last)
            <hr class="mb-4" style="border-color: #1BC98E">
        @endif
    @endforeach

</div>