@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">
                @if($number === 1)

                    <div class="card card-inverse card-square border-bottom-pink border-right-pink" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <h4 class="card-title pink">{{$name}}
                                <canvas id="device-status-circle" class="ml-2" width="30" height="25" data-toggle="tooltip" data-placement="top" title="Status"></canvas>
                            </h4>
                            <p class="card-text text-white">This is endpoint {{$name}}</p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>


                            <h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>
                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a href="/accounts/{{$endpoint->account->id}}">{{$endpoint->account->name}}</a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7">{{$endpoint->name}}</div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7">{{$endpoint->ip}}</div>
                                        <div class="col-lg-5">Mac Address</div>
                                        <div class="col-lg-7">{{$endpoint->mac}}</div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7">{{$endpoint->model}}</div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7">{{$endpoint->proxy}}</div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7">{{$recordcount}}</div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7">{{$durationaverage}} seconds</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="card card-inverse card-square border-bottom-teal border-right-teal" style="border-top: none; border-left: none; background-color: transparent; ">
                        <div class="card-block">

                            <h4 class="card-title teal">{{$name}}
                                <canvas id="device-status-circle" class="ml-2" width="30" height="25" data-toggle="tooltip" data-placement="top" title="Status"></canvas>
                            </h4>
                            <p class="card-text text-white">This is endpoint {{$name}}</p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>


                            <h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>
                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a href="/accounts/{{$endpoint->account->id}}">{{$endpoint->account->name}}</a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7">{{$endpoint->name}}</div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7">{{$endpoint->ip}}</div>
                                        <div class="col-lg-5">Mac Address</div>
                                        <div class="col-lg-7">{{$endpoint->mac}}</div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7">{{$endpoint->model}}</div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7">{{$endpoint->proxy}}</div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7">{{$recordcount}}</div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7">{{$durationaverage}} seconds</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="card card-inverse card-square border-bottom-purple border-right-purple" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <h4 class="card-title purple">{{$name}}
                                <canvas id="device-status-circle" class="ml-2" width="30" height="25" data-toggle="tooltip" data-placement="top" title="Status"></canvas>
                            </h4>
                            <p class="card-text text-white">This is endpoint {{$name}}</p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>

                            <h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>
                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a href="/accounts/{{$endpoint->account->id}}">{{$endpoint->account->name}}</a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7">{{$endpoint->name}}</div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7">{{$endpoint->ip}}</div>
                                        <div class="col-lg-5">Mac Address</div>
                                        <div class="col-lg-7">{{$endpoint->mac}}</div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7">{{$endpoint->model}}</div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7">{{$endpoint->proxy}}</div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7">{{$recordcount}}</div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7">{{$durationaverage}} seconds</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($number === 4)

                    <div class="card card-inverse card-square border-bottom-yellow border-right-yellow" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <h4 class="card-title yellow">{{$name}}
                                <canvas id="device-status-circle" class="ml-2" width="30" height="25" data-toggle="tooltip" data-placement="top" title="Status"></canvas>
                            </h4>
                            <p class="card-text text-white">This is endpoint {{$name}}</p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>

                            <h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>
                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a href="/accounts/{{$endpoint->account->id}}">{{$endpoint->account->name}}</a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7">{{$endpoint->name}}</div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7">{{$endpoint->ip}}</div>
                                        <div class="col-lg-5">Mac Address</div>
                                        <div class="col-lg-7">{{$endpoint->mac}}</div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7">{{$endpoint->model}}</div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7">{{$endpoint->proxy}}</div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7">{{$recordcount}}</div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7">{{$durationaverage}} seconds</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @else

                    <div class="card card-inverse card-square border-bottom-blue border-right-blue" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <h4 class="card-title blue">{{$name}}
                                <canvas id="device-status-circle" class="ml-2" width="30" height="25" data-toggle="tooltip" data-placement="top" title="Status"></canvas>
                            </h4>
                            <p class="card-text text-white">This is endpoint {{$name}}</p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>

                            <h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>
                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a href="/accounts/{{$endpoint->account->id}}">{{$endpoint->account->name}}</a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7">{{$endpoint->name}}</div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7">{{$endpoint->ip}}</div>
                                        <div class="col-lg-5">Mac Address</div>
                                        <div class="col-lg-7">{{$endpoint->mac}}</div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7">{{$endpoint->model}}</div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7">{{$endpoint->proxy}}</div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7">{{$recordcount}}</div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7">{{$durationaverage}} seconds</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>

        <div class="col-lg-12 mt-5 mb-4" style="padding: 0;">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div id="container_two"></div>
                </div>

                <div class="col-lg-6">
                    <div id="container_one"></div>
                </div>
            </div>
        </div>

        <div class="card card-square mb-lg-5" style="background-color: transparent; border: none;">
            <ul id="account-card-header" class="nav nav-tabs active-outline-card-header-pink" role="tablist">
                <li id="insights" class="nav-item">
                    <a id="insights-a" class="nav-link active-outline-tab-pink text-white" data-toggle="tab" href="#account-card-block-insights-tab" role="tab">Insights</a>
                </li>
                <li id="locations" class="nav-item">
                    <a id="locations-a" class="nav-link teal" data-toggle="tab" href="#account-card-block-locations-tab" role="tab">Locations</a>
                </li>
                <li id="contacts" class="nav-item">
                    <a id="contacts-a" class="nav-link blue" data-toggle="tab" href="#account-card-block-contacts-tab" role="tab">Contacts</a>
                </li>
                <li id="notes" class="nav-item">
                    <a id="notes-a" class="nav-link yellow" data-toggle="tab" href="#account-card-block-notes-tab" role="tab">Notes</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane card-block active active-outline-card-block-pink" id="account-card-block-insights-tab" role="tabpanel">
                    <h4 class="card-title text-white">Special title treatment</h4>
                    <p class="card-text text-white">With supporting text below as a natural lead-in to additional content.</p>
                    <a id="account-card-block-a" href="#" class="btn btn-nav-pink ">Go somewhere</a>
                </div>
                <div class="tab-pane card-block active-outline-card-block-teal" id="account-card-block-locations-tab" role="tabpanel">
                    <h4 class="card-title text-white">Special title treatment</h4>
                    <p class="card-text text-white">With supporting text below as a natural lead-in to additional content.</p>
                    <a id="account-card-block-a" href="#" class="btn btn-nav-teal ">Go somewhere</a>

                </div>

                <div class="tab-pane card-block active-outline-card-block-blue" id="account-card-block-contacts-tab" role="tabpanel">
                    <h4 class="card-title text-white">Special title treatment</h4>
                    <p class="card-text text-white">With supporting text below as a natural lead-in to additional content.</p>
                    <a id="account-card-block-a" href="#" class="btn btn-nav-blue ">Go somewhere</a>
                </div>


                <div class="tab-pane card-block active-outline-card-block-yellow" id="account-card-block-notes-tab" role="tabpanel">
                    <h4 class="card-title text-white">Special title treatment</h4>
                    <p class="card-text text-white">With supporting text below as a natural lead-in to additional content.</p>
                    <a id="account-card-block-a" href="#" class="btn btn-nav-yellow ">Go somewhere</a>
                </div>

            </div>


        </div>

    </div>

@endsection