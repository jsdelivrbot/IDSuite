@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                @php
                    $number = rand(1,5);
                @endphp

                @if($number === 1)

                    <div class="card card-inverse card-square border-bottom-pink border-right-pink" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <div>
                                <h4 id="header-title" class="card-title pink">
                                </h4>
                                @include('measure.partials.device_status.device_status')
                            </div>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>


                            {{--<h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>--}}

                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a id="account-name"></a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7" id="endpoint-name"></div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7" id="endpoint-ip"></div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7" id="endpoint-model"></div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7" id="endpoint-proxy"></div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7" id="endpoint-call-count"></div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7" id="endpoint-average-call-duration"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($number === 2)

                    <div class="card card-inverse card-square border-bottom-teal border-right-teal" style="border-top: none; border-left: none; background-color: transparent; ">
                        <div class="card-block">

                            <div>
                                <h4 id="header-title" class="card-title teal">
                                </h4>
                                @include('measure.partials.device_status.device_status')
                            </div>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>


                            {{--<h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>--}}

                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a id="account-name"></a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7" id="endpoint-name"></div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7" id="endpoint-ip"></div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7" id="endpoint-model"></div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7" id="endpoint-proxy"></div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7" id="endpoint-call-count"></div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7" id="endpoint-average-call-duration"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($number === 3)

                    <div class="card card-inverse card-square border-bottom-purple border-right-purple" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <div>
                                <h4 id="header-title" class="card-title purple">
                                </h4>
                                @include('measure.partials.device_status.device_status')
                            </div>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>

                            {{--<h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>--}}

                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a id="account-name"></a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7" id="endpoint-name"></div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7" id="endpoint-ip"></div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7" id="endpoint-model"></div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7" id="endpoint-proxy"></div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7" id="endpoint-call-count"></div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7" id="endpoint-average-call-duration"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($number === 4)

                    <div class="card card-inverse card-square border-bottom-yellow border-right-yellow" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <div>
                                <h4 id="header-title" class="card-title yellow">
                                </h4>
                                @include('measure.partials.device_status.device_status')
                            </div>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>

                            {{--<h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>--}}

                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a id="account-name"></a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7" id="endpoint-name"></div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7" id="endpoint-ip"></div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7" id="endpoint-model"></div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7" id="endpoint-proxy"></div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7" id="endpoint-call-count"></div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7" id="endpoint-average-call-duration"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                @else

                    <div class="card card-inverse card-square border-bottom-blue border-right-blue" style="border-top: none; border-left: none; background-color: transparent;">
                        <div class="card-block">

                            <div>
                                <h4 id="header-title" class="card-title blue">
                                </h4>
                                @include('measure.partials.device_status.device_status')
                            </div>
                            <p id="header-title-description" class="card-text text-white"></p>

                            <div class="float-right mr-4">
                                <button class="btn btn-nav-teal my-2 my-sm-0" type="submit">Disable</button>
                                <button class="btn btn-nav-purple my-2 my-sm-0" type="submit">Reboot</button>
                                <button class="btn btn-nav-yellow my-2 my-sm-0" type="submit">Upload Logs</button>
                                <button class="btn btn-nav-blue my-2 my-sm-0" type="submit">Sync Records</button>
                            </div>

                            {{--<h5 class="card-title mt-2 text-white">{{$endpoint->name}}</h5>--}}

                            <div class="card-text text-white">
                                <ul class="list-group row" style="background-color: transparent;">
                                    <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">
                                        <div class="col-lg-5">Account Name</div>
                                        <div class="col-lg-7"><a id="account-name"></a></div>
                                        <div class="col-lg-5">Name</div>
                                        <div class="col-lg-7" id="endpoint-name"></div>
                                        <div class="col-lg-5">IP Address</div>
                                        <div class="col-lg-7" id="endpoint-ip"></div>
                                        <div class="col-lg-5">Model</div>
                                        <div class="col-lg-7" id="endpoint-model"></div>
                                        <div class="col-lg-5">Proxy</div>
                                        <div class="col-lg-7" id="endpoint-proxy"></div>
                                        <div class="col-lg-5">Call Count</div>
                                        <div class="col-lg-7" id="endpoint-call-count"></div>
                                        <div class="col-lg-5">Avg Call Time</div>
                                        <div class="col-lg-7" id="endpoint-average-call-duration"></div>
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

        @include('measure.partials.custom_tabs.custom_tabs')

    </div>

@endsection


@push('device_scripts')

    <script>

        /**
         *
         * setHeaderCard
         *
         * set headers in cards
         *
         **/
        function setHeaderCard(endpoint) {

            console.log(endpoint);

            $('#header-title').text(endpoint.name);

            $('#header-title-description').text('This is endpoint ' + endpoint.name);

            $('#account-name')
                .text(endpoint.entity_name)
                .attr('href', '/measure/accounts/' + endpoint.entity.id);

            $('#endpoint-name').text(endpoint.name);

            $('#endpoint-ip').text(endpoint.ip);

            $('#endpoint-model').text(endpoint.model);

            $('#endpoint-proxy').text(endpoint.proxy);

            $('#endpoint-call-count').text(endpoint.call_count);

            $('#endpoint-average-call-duration').text(endpoint.average_call_duration + ' seconds');
        }

        /**
         *
         * getEndpoint
         *
         * gets endpoint object and validates it
         *
         * @param endpoint_id
         */
        function getEndpoint(endpoint_id) {

            let options = JSON.stringify({
                id: endpoint_id
            });

            return axios.get('/api/endpoint/' + options)
                .then(function (data) {
                    let response = data.data;

                    if(!validate(response)){
                        return false;
                    }

                    let endpoint = data.data;

                    setHeaderCard(endpoint);
                });
        }


        $(document).ready(function () {


            console.log('test');

            axiosrequests.push = getEndpoint('{{$endpoint->id}}');


        });

    </script>

@endpush