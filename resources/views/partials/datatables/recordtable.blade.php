    <section class="offset-lg-1 col-lg-10">
        <table class="table table-bordered hide" id="records-table">
            <thead>
            <tr>
                <th>Local Name</th>
                <th>Remote Name</th>
                <th>Start Time</th>
                <th>Duration</th>
                <th>Details</th>
            </tr>
            </thead>
        </table>
    </section>

    <div class="modal" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transaction Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group row" style="background-color: transparent;">
                        <li class="col-lg-10 list-group-item" style="background-color: transparent; border: none;">

                            <div class="col-lg-5">Record ID</div>
                            <div class="col-lg-7" id="record-id"></div>

                            <div class="col-lg-5">Endpoint ID</div>
                            <div class="col-lg-7" id="endpoint-id"></div>

                            <div class="col-lg-5">Start Time</div>
                            <div class="col-lg-7" id="start-time"></div>

                            <div class="col-lg-5">End Time</div>
                            <div class="col-lg-7" id="end-time"></div>

                            <div class="col-lg-5">Duration</div>
                            <div class="col-lg-7" id="duration"></div>

                            <div class="col-lg-5">Local ID</div>
                            <div class="col-lg-7" id="local-id"></div>

                            <div class="col-lg-5">Conference ID</div>
                            <div class="col-lg-7" id="conference-id"></div>

                            <div class="col-lg-5">Local Name</div>
                            <div class="col-lg-7" id="local-name"></div>

                            <div class="col-lg-5">Local Number</div>
                            <div class="col-lg-7" id="local-number"></div>

                            <div class="col-lg-5">Remote Name</div>
                            <div class="col-lg-7" id="remote-name"></div>

                            <div class="col-lg-5">Remote Number</div>
                            <div class="col-lg-7" id="remote-number"></div>

                            <div class="col-lg-5">Dialed Digits</div>
                            <div class="col-lg-7" id="dialed-digits"></div>

                            <div class="col-lg-5">Direction</div>
                            <div class="col-lg-7" id="direction"></div>

                            <div class="col-lg-5">Protocol</div>
                            <div class="col-lg-7" id="protocol"></div>

                            <div class="col-lg-5">Distance by Car</div>
                            <div class="col-lg-7" id="distance-text"></div>

                            <div class="col-lg-5">Drive Duration</div>
                            <div class="col-lg-7" id="drive-duration"></div>

                            <div class="col-lg-5">Mileage Cost</div>
                            <div class="col-lg-7" id="mileage"></div>

                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-lg-12" style="height: 300px;">
                            <div id="map" style="width: 100%; height: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="note-cancel" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                </div>
            </div>
        </div>
    </div>

@push('transaction_data_table')
    {{--<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap" async defer></script>--}}
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=geometry"></script>


    @php

        if($viewname === 'account'){
            session(['data_table_id' => session('currentaccount')]);

        } else {
            session(['data_table_id' => null]);
        }

    @endphp

    <script>
    $( document ).ready(function() {

        $('#records-table').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 10,
            ajax: '/getRecordsDataTables',
            columnDefs: [
                {
                    targets: 0,
                    data: 'local_name',
                    name: 'local_name',
                    defaultContent: "<i>Not Available<i>",
                    render: function (data) {
                        if (data === "") {
                            return '<i>Not Available<i>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    targets: 1,
                    data: 'remote_name',
                    name: 'remote_name',
                    defaultContent: "<i>Not Available<i>",
                    render: function (data) {
                        if (data === "") {
                            return '<i>Not Available<i>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    targets: 2,
                    data: 'start',
                    name: 'timeperiod.start',
                    defaultContent: "<i>Not Available<i>",
                },
                {
                    targets: 3,
                    data: 'duration',
                    name: 'timeperiod.duration',
                    defaultContent: "<i>Not Available<i>",
                },
                {
                    targets: 4,
                    data: 'record_id',
                    name: 'id',
                    className: "text-center",
                    render: function (data, type, full, meta) {

                        console.log('data : ' + data);

                        return '<button class="btn btn-nav-teal" data-toggle="modal" data-target="#detailModal" onclick="getRecordDetails(\'' + data + '\')">Details</button>';
                    }
                },
            ]
        });
    });

    function getRecordDetails(id) {

        $('#record-id').text("");
        $('#start-time').text("");
        $('#end-time').text("");
        $('#duration').text("");
        $('#local-id').text("");
        $('#conference-id').text("");
        $('#local-name').text("");
        $('#local-number').text("");
        $('#remote-name').text("");
        $('#remote-number').text("");
        $('#dialed-digits').text("");
        $('#direction').text("");
        $('#protocol').text("");

        $.ajax({
            type: "GET",
            url: '/getRecordDetails',
            data: {
                id: id
            },
            success: function (data) {

                $('#record-id').text(data.id);
                $('#endpoint-id').html('<a href="/devices/'+data.endpoint_id+'">'+data.endpoint_id+'</a>');
                $('#start-time').text(data.timeperiod.start);
                $('#end-time').text(data.timeperiod.end);
                $('#duration').text(data.timeperiod.duration + ' seconds');
                $('#local-id').text(data.local_id);
                $('#conference-id').text(data.conference_id);
                $('#local-name').text(data.local_name);
                $('#local-number').text(data.local_number);
                $('#remote-name').text(data.remote_name);
                $('#remote-number').text(data.remote_number);
                $('#dialed-digits').text(data.dialed_digits);
                $('#direction').text(data.direction);
                $('#protocol').text(data.protocol);


                let local_location = new google.maps.LatLng(data.local_lat, data.local_lng);

                let remote_location = new google.maps.LatLng(data.remote_lat, data.remote_lng);

                let center = google.maps.geometry.spherical.interpolate(local_location,remote_location, .5);

                let distance = Math.round(0.000621371192 * google.maps.geometry.spherical.computeDistanceBetween(local_location, remote_location));

                let mileage_cost = .535 * distance;

                let map;

//                console.log('local_location : ' + local_location);
//                console.log('remote_location : ' + remote_location);
//                console.log(center.lat());
//
//                console.log("distance : " + distance);
//
//                console.log("mileage costs : $" + mileage_cost);

                let service = new google.maps.DistanceMatrixService();

                service.getDistanceMatrix(
                    {
                        origins: [local_location],
                        destinations: [remote_location],
                        travelMode: 'DRIVING',
                        unitSystem: google.maps.UnitSystem.IMPERIAL,
                        avoidHighways: false,
                        avoidTolls: true,
                    }, getDistance);

                function getDistance(response, status) {
                    if (status == 'OK') {
                        let origins = response.originAddresses;
                        let destinations = response.destinationAddresses;

                        for (let i = 0; i < origins.length; i++) {
                            let results = response.rows[i].elements;
                            for (let j = 0; j < results.length; j++) {
                                let element = results[j];
                                let distance_text = element.distance.text;

                                let distance_val = element.distance.value * 0.000621371192;
                                let duration = element.duration.text;
                                let mileage_cost = Math.round(.535 * distance_val);
                                let from = origins[i];
                                let to = destinations[j];

                                $('#distance-text').text(distance_text);
                                $('#mileage').text("$" + mileage_cost + ".00");
                                $('#drive-duration').text(duration);
                            }
                        }
                    }
                }

                initMap(local_location, remote_location, center);

                function initMap(local_location, remote_location, center) {
                    let directionsService = new google.maps.DirectionsService;
                    let directionsDisplay = new google.maps.DirectionsRenderer;

                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: center.lat(),lng: center.lng()},
                        zoom: 8
                    });

                    directionsDisplay.setMap(map);

                    let bounds = new google.maps.LatLngBounds(local_location, remote_location);

                    map.fitBounds(bounds);

                    calculateAndDisplayRoute(directionsService, directionsDisplay);

                    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
                        directionsService.route({
                            origin: local_location,
                            destination: remote_location,
                            travelMode: 'DRIVING'
                        }, function(response, status) {
                            if (status === 'OK') {
                                directionsDisplay.setDirections(response);
                            } else {
                                window.alert('Directions request failed due to ' + status);
                            }
                        });
                    }
                }
            },
        });


    }
</script>

<style>
    .dataTables_wrapper .dataTables_info{
        color: #fff;
    }

    .dataTables_wrapper .dataTables_length{
        color: #fff;
    }
    table.dataTable tbody tr{
        background-color: transparent;
        color: #fff;
    }

    table.dataTable thead th, table.dataTable thead td{
        color: #fff;
    }

    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate{
        color: #fff;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        color: #fff !important;
    }
</style>
@endpush