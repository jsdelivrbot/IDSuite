@extends('layouts.medsitter')

@section('content')


    <section class="row mt-3">

        <div class="col-lg-8" style="margin-left: 2.5%;">
            <div class="card text-white" style="background-color: transparent;border: none">
                <div class="card-block">
                    <h1 class="card-title" style="border: none;">Pod Dashboard</h1>
                </div>
            </div>
        </div>

    </section>

    <section class="mb-5" style="margin-left: 3.75%;">
        <div class="card-deck">
            <div class="card card-purple">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Active Patients</h4>
                        <h1 id="active-patient-count" class="card-title">{{$active_paitient_count}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-orange">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Total Active Sitters</h4>
                        <h1 class="card-title">{{$active_sitter_count}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-pink">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Pods Created</h4>
                        <h1 class="card-title">{{count($pods)}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-blue">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Active Pods </h4>

                        @php
                            $active_pod_count = 0;

                            foreach($pods as $pod){

                                if($pod->active === 1){
                                    $active_pod_count++;
                                }
                            }

                        @endphp

                        <h1 class="card-title">{{$active_pod_count}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-yellow">
                <div class="card-block">
                    <div class="text-center">
                        <h5 class="card-title">Patient to Sitter Ratio</h5>
                        <h1 class="card-title">{{$sitter_to_patient_ratio}}</h1>
                    </div>
                </div>
            </div>

            <div class="card card-teal" style="margin-right: 3.75%;">
                <div class="card-block">
                    <div class="text-center">
                        <h4 class="card-title">Alerts</h4>
                        <h1 class="card-title">2</h1>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <div class="row mt-4">
        <div class="col-lg-11" style="margin-left: 3.75%;">
            <a id="pod-modal-button" data-toggle="modal" data-target="#podModal" class="btn btn-outline-teal text-white" role="button"><i class="fa fa-plus"></i> Create Pod</a>
        </div>
    </div>

    <div id="pods" class="mt-4">

    @foreach($pods as $pod)

            @if($pod->active === 1)
            <div class="row mt-2" id="pod-row-{{$pod->id}}">
                <div class="col-lg-11" style="margin-left: 3.75%;">
                    <div class="card" style="background-color: #434857 !important">
                        <div class="card-block text-white" style="padding: 8px;">
                            <div class="row" id="pod-inner-row-{{$pod->id}}">
                                <div class="col-lg-1 align-self-center">

                                    @if($pod->patient_count < 4 && $pod->sitter_count > 0)
                                        <a id="pod-patient-link-{{$pod->id}}" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal"  role="button" onclick="changeSubmit('{{$pod->id}}')">Patient</a>
                                    @else
                                        <a id="pod-patient-link-{{$pod->id}}" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal disabled" role="button" onclick="changeSubmit('{{$pod->id}}')">Patient</a>
                                    @endif

                                </div>
                                <div class="col-lg-1 align-self-center ml-3 text-white">
                                    @if($pod->sitter_count === 0)
                                        <a id="pod-sitter-link-{{$pod->id}}" class="btn btn-outline-orange sitter-button" href="/medsitter/sitter/{{$pod->id}}" role="button">Sitter</a>
                                    @else
                                        <a id="pod-sitter-link-{{$pod->id}}" class="btn btn-outline-orange sitter-button disabled" href="/medsitter/sitter/{{$pod->id}}" role="button">Sitter</a>
                                    @endif
                                </div>
                                <div class="col-lg-3 align-self-center">
                                    <div class="ml-5 ">
                                        <span id="pod-name-{{$pod->id}}">{{$pod->name}}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 align-self-center">
                                    <div class="progress">
                                        <div id="pod-participant-count-{{$pod->id}}" class="progress-bar" role="progressbar" style="width: {{100*($pod->patient_count/4)}}%" aria-valuenow="{{100*($pod->patient_count/4)}}%" aria-valuemin="0" aria-valuemax="100">{{$pod->patient_count}} / 4</div>
                                    </div>
                                </div>

                                <div class="col-lg-2 align-self-center">
                                    <span id="pod-sitter-count-{{$pod->id}}">{{$pod->sitter_count}}</span><span> Sitter(s)</span>
                                    <span id="pod-patient-count-{{$pod->id}}">{{$pod->patient_count}}</span><span> Patient(s)</span>
                                </div>
                                @if($pod->active_count === 0)
                                    <div class="col-lg-1 align-self-center" id="pod-delete-col-{{$pod->id}}">
                                        <a id="pod-delete-link-{{$pod->id}}" data-toggle="modal" data-target="#podDeleteModal" class="btn btn-outline-pink"  role="button" onclick="updateDeletePodModal('{{$pod->name}}', '{{$pod->id}}');" ><i class="fa fa-minus"></i> Delete</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    @endforeach
    </div>


    <!-- Paitent Modal Form-->
    <div class="modal" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="patientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Patient Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="patient-form">
                        <div class="form-group">
                            <label for="patient-first-name">First Name</label>
                            <input class="form-control" id="patient-first-name" placeholder="Jane" minlength="2" type="text" required/>
                        </div>
                        <div class="form-group">
                            <label for="patient-last-name-last-name">Last Name</label>
                            <input class="form-control" id="patient-last-name" placeholder="Doe" minlength="2" type="text" required/>
                        </div>
                        <div class="form-group">
                            <label for="patient-contact-number">Contact Phone Number</label>
                            <input class="form-control" id="patient-contact" placeholder="" required/>
                        </div>
                        <div class="form-group">
                            <label for="contact-preferred-name">Microphone Privacy</label>
                            <input type="radio" class="form-control" name="patient-microphone-status" value="muted"> Muted<br>
                            <input type="radio" class="form-control" name="patient-microphone-status" value="active"> Active<br>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a id="patient-cancel" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                    <a id="patient-submit" value="" class="btn btn-nav-orange" style="cursor: pointer !important;"><i class="fa fa-plus"></i> Submit</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Paitent Form-->

    <!-- Patient Waiting Modal-->
    <div class="modal" id="waitingModal" tabindex="-1" role="dialog" aria-labelledby="waitingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Joining</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Waiting for Sitter to seat you...
                </div>
            </div>
        </div>
    </div>
    <!--End Patient Waiting Form-->

    <!-- Create Pod Modal Form-->
    <div class="modal" id="podModal" tabindex="-1" role="dialog" aria-labelledby="podModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Pod</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pod-form">
                        <div class="form-group">
                            <label for="pod-name">Pod Name</label>
                            <input class="form-control" id="pod-name" placeholder="Enter Pod Name..." minlength="3" type="text" required/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a id="pod-cancel" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                    <a id="pod-submit" value="" class="btn btn-nav-orange" style="cursor: pointer !important;"><i class="fa fa-plus"></i> Submit</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Create Pod Form-->


    <!-- Delete Pod Modal Form-->
    <div class="modal" id="podDeleteModal" tabindex="-1" role="dialog" aria-labelledby="podDeleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Pod</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="delete-pod-name">

                    </span>
                </div>
                <div class="modal-footer">
                    <a id="pod-cancel" class="btn btn-nav-yellow" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                    <a id="pod-delete-confirm" value="" class="btn btn-nav-pink" style="cursor: pointer !important;"><i class="fa fa-plus"></i> Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Delete Pod Form-->


@endsection


@push('medsitter_library')
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/gauge.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>


    <script type="text/javascript">


        $('.sitter-button').on('click', function(){

            $(this).addClass('disabled');

        });


        $('#pod-submit').click(function(){

            let name = $('#pod-name').val();

            $.ajax({
                type: "POST",
                url: '/medsitter/pod',
                data: {
                    name: name
                },
                success: function (data) {
                    $('#podModal').modal("hide");
                }
            });

        });


        function updateDeletePodModal(name, id){
            $('#delete-pod-name')
                .text("Are you sure you want to delete Pod " + name + "?");

            $('#pod-delete-confirm')
                .attr('onclick', "podDelete(\""+id+"\")");

        }


        function podDelete(id){

            $.ajax({
                type: "POST",
                url: '/medsitter/pod/delete',
                data: {
                    id: id
                },
                success: function (response) {

                    $('#podDeleteModal').modal('hide');

                    if(response){
                        $('#pod-row-' + id).addClass('d-none');
                    } else {
                        alert("Delete Failed");
                    }


                }
            });

        }




    </script>



    <script type="text/javascript">


        Echo.private('medsitter-join-url')
            .listen('EventJoinPatient', event => {


                if(room_key === event.key) {
                    window.location.href = event.url;
                }

                let count = parseInt($('#active-patient-count').text()) + 1;


                $('#active-patient-count').text(count);

            });


        Echo.private('medsitter-pods')
            .listen('LivePods', event => {
                updateValues(event.pod);

            });


        Echo.private('medsitter-pod-count')
            .listen('PodCount', event => {

                console.log("update count");

                let pod = event.pod;

                console.log(event.pod);

                updateCount(pod);

            });


        function updateCount(pod) {

            let value = 100*(pod.patient_count / 4);

            $('#pod-participant-count-' + pod.id)
                .css("width", value + "%")
                .attr("aria-valuenow", value + "%")
                .text(pod.patient_count +  " / 4");

            $('#pod-sitter-count-' + pod.id)
                .text(pod.sitter_count);

            $('#pod-patient-count-' + pod.id)
                .text(pod.patient_count);


            if(pod.patient_count < 4 && pod.sitter_count > 0){

                console.log("enabled");

                $("#pod-patient-link-" + pod.id).removeClass("disabled");

            } else {

                console.log("disabled");

                $("#pod-patient-link-" + pod.id).addClass("disabled");

            }

            if(pod.sitter_count === 0){

                console.log("disable sitter button");

                $("#pod-sitter-link-" + pod.id).removeClass("disabled");
            } else {

                console.log("disable sitter button");

                $("#pod-sitter-link-" + pod.id).addClass("disabled");
            }

            if(pod.active_count === 0){
                $('#pod-inner-row-' + pod.id)
                    .append('<div class="col-lg-1 align-self-center" id="pod-delete-col-'+pod.id+'">' +
                        '   <a id="pod-delete-link-'+pod.id+'" data-toggle="modal" data-target="#podDeleteModal" class="btn btn-outline-pink"  role="button" onclick="updateDeletePodModal(\''+pod.name+'\', \''+pod.id+'\');" ><i class="fa fa-minus"></i> Delete</a>' +
                        '</div>');
            } else {
                $('#pod-delete-col-' + pod.id).remove();
            }

            console.log("updated count");

        }

        function updateValues (pod){

            if(pod.completed === 0){
                pod.completed = 'false';
            } else {
                pod.completed = 'true';
            }

            let styleWidth = 100 * (pod.patient_count / 4);
            let ariaValueNow = 100 * (pod.patient_count / 4);


            $('#pods').prepend('<div class="row mt-2">' +
                '                   <div class="col-lg-11" style="margin-left: 3.75%;">' +
                '                       <div class="card" style="background-color: #434857 !important">' +
                '                           <div class="card-block text-white" style="padding: 8px;">' +
                '                               <div class="row" id="pod-inner-row'+pod.id+'">' +
                '                                   <div id="patient-links-'+pod.id+'" class="col-lg-1 align-self-center">' +
                '                                   </div>' +
                '                                   <div class="col-lg-1 align-self-center ml-3">' +
                '                                       <a id="pod-sitter-link-'+pod.id+'" class="btn btn-outline-orange" href="/medsitter/sitter/'+pod.id+'" role="button">Sitter</a>' +
                '                                   </div>' +
                '                                   <div class="col-lg-3 align-self-center">' +
                '                                       <div class="ml-5 ">' +
                '                                           <span id="pod-name-'+pod.id+'">'+pod.name+'</span>' +
                '                                       </div>' +
                '                                   </div>' +
                '                                   <div class="col-lg-3 align-self-center">' +
                '                                       <div class="progress">' +
                '                                           <div id="pod-participant-count-'+pod.id+'" class="progress-bar" role="progressbar" style="width: '+styleWidth+'%" aria-valuenow="'+ariaValueNow+'%" aria-valuemin="0" aria-valuemax="100">'+pod.patient_count+'/4</div>' +
                '                                       </div>' +
                '                                   </div>' +
                '                                   <div class="col-lg-2 align-self-center">' +
                '                                       <span id="pod-sitter-count-'+pod.id+'">'+pod.sitter_count+'</span><span> Sitter(s)</span>' +
                '                                       <span id="pod-patient-count-'+pod.id+'">'+pod.patient_count+'</span><span> Patient(s)</span>' +
                '                                   </div>' +
                '                                   <div class="col-lg-1 align-self-center" id="pod-delete-col-'+pod.id+'">' +
                '                                       <a id="pod-delete-link-'+pod.id+'" data-toggle="modal" data-target="#podDeleteModal" class="btn btn-outline-pink"  role="button" onclick="updateDeletePodModal(\''+pod.name+'\', \''+pod.id+'\');" ><i class="fa fa-minus"></i> Delete</a>' +
                '                               </div>' +
                '                           </div>' +
                '                       </div>' +
                '                   </div>' +
                '               </div>');

            if(pod.patient_count < 4 && pod.sitter_count > 0){
                $('#patient-links-'+pod.id).append('<a id="pod-patient-link-'+pod.id+'" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal"  role="button" onclick="changeSubmit(\''+pod.id+'\')">Patient</a>');
            } else {
                $('#patient-links-'+pod.id).append('<a id="pod-patient-link-'+pod.id+'" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal disabled" role="button" onclick="changeSubmit(\''+pod.id+'\')">Patient</a>')
            }

        }

        function changeSubmit(podId) {
            $('#patient-submit').attr('value', podId);
        }

    </script>

    <script>
        let gaugeChart = AmCharts.makeChart("pod-chart", {
            "type": "gauge",
            "theme": "dark",
            "axes": [{
                "axisAlpha": 0,
                "tickAlpha": 0,
                "labelsEnabled": false,
                "startValue": 0,
                "endValue": 100,
                "startAngle": 0,
                "endAngle": 270,
                "bands": [{
                    "color": "#eee",
                    "startValue": 0,
                    "endValue": 100,
                    "radius": "100%",
                    "innerRadius": "85%"
                }, {
                    "color": "#84b761",
                    "startValue": 0,
                    "endValue": 80,
                    "radius": "100%",
                    "innerRadius": "85%",
                    "balloonText": "90%"
                }, {
                    "color": "#eee",
                    "startValue": 0,
                    "endValue": 100,
                    "radius": "80%",
                    "innerRadius": "65%"
                }, {
                    "color": "#fdd400",
                    "startValue": 0,
                    "endValue": 35,
                    "radius": "80%",
                    "innerRadius": "65%",
                    "balloonText": "35%"
                }, {
                    "color": "#eee",
                    "startValue": 0,
                    "endValue": 100,
                    "radius": "60%",
                    "innerRadius": "45%"
                }, {
                    "color": "#cc4748",
                    "startValue": 0,
                    "endValue": 92,
                    "radius": "60%",
                    "innerRadius": "45%",
                    "balloonText": "92%"
                }, {
                    "color": "#eee",
                    "startValue": 0,
                    "endValue": 100,
                    "radius": "40%",
                    "innerRadius": "25%"
                }, {
                    "color": "#67b7dc",
                    "startValue": 0,
                    "endValue": 68,
                    "radius": "40%",
                    "innerRadius": "25%",
                    "balloonText": "68%"
                }]
            }],
            "allLabels": [{
                "text": "First option",
                "x": "49%",
                "y": "5%",
                "size": 15,
                "bold": true,
                "color": "#84b761",
                "align": "right"
            }, {
                "text": "Second option",
                "x": "49%",
                "y": "15%",
                "size": 15,
                "bold": true,
                "color": "#fdd400",
                "align": "right"
            }, {
                "text": "Third option",
                "x": "49%",
                "y": "24%",
                "size": 15,
                "bold": true,
                "color": "#cc4748",
                "align": "right"
            }, {
                "text": "Fourth option",
                "x": "49%",
                "y": "33%",
                "size": 15,
                "bold": true,
                "color": "#67b7dc",
                "align": "right"
            }]
        });
    </script>
    <script>

        let room_key;

        $('#patient-submit').click(function(){

            let firstname = $('#patient-first-name').val();
            let lastname = $('#patient-last-name').val();
            let phonenumber = $('#patient-contact').val();
            let microphonestatus = $('#patient-microphone-status').val();


            let podid = $(this).attr('value');

            console.log(podid);


            $.ajax({
                type: "POST",
                url: "/medsitter/participant",
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    phonenumber: phonenumber,
                    microphonestatus: microphonestatus,
                    type: "patient",
                    podid: podid
                },
                success: function (data) {
                    // add note dynamically to note list //

                    room_key = data.key;

                    $('#patientModal').modal('toggle');

                    $('#waitingModal').modal('toggle');

                }
            });
        });


        $(function(){

            $.ajax({
                type: "GET",
                url: "/medsitter/getPods",
                success: function(pods){

                    $.each(pods, function(key, value){

                        let pod = pods[key];

                        let elSit = $('#pod-sitter-count-' + pod.id);

                        let elPat = $('#pod-patient-count-' + pod.id);

                        let sitter_val = parseInt(elSit.text());
                        let patient_val = parseInt(elPat.text());

                        console.log(sitter_val);
                        console.log(patient_val);

                        if(pod.sitter_count !== sitter_val) {
                            elSit.text(pod.sitter_count);

                            if(pod.sitter_count === 0){
                                $('#pod-sitter-link-' + pod.id).removeClass("disabled");

                                if(pod.active_count === 0){

                                    $('#pod-patient-link-' + pod.id).addClass("disabled");

                                    $('#pod-inner-row-' + pod.id)
                                        .append('<div class="col-lg-1 align-self-center" id="pod-delete-col-'+pod.id+'">' +
                                            '   <a id="pod-delete-link-'+pod.id+'" data-toggle="modal" data-target="#podDeleteModal" class="btn btn-outline-pink"  role="button" onclick="updateDeletePodModal(\''+pod.name+'\', \''+pod.id+'\');" ><i class="fa fa-minus"></i> Delete</a>' +
                                            '</div>');
                                }

                            }

                        }

                        if(pod.patient_count !== patient_val){
                            elPat.text(pod.patient_count);

                            let styleWidth = 100 * (pod.patient_count / 4);
                            let ariaValueNow = 100 * (pod.patient_count / 4);


                            console.log('styleWidth : ' + styleWidth);
                            console.log('ariaValueNow : ' + ariaValueNow);
                            console.log('pod.patient_count : ' + pod.patient_count);


                            $('#pod-participant-count-' + pod.id)
                                .css("width", styleWidth)
                                .attr("aria-valuenow", ariaValueNow + "%")
                                .text(pod.patient_cound + " / 4");


                            console.log("change")

                            if(pod.active_count === 0) {
                                $('#pod-patient-link-' + pod.id).addClass("disabled");

                                $('#pod-inner-row-' + pod.id)
                                    .append('<div class="col-lg-1 align-self-center" id="pod-delete-col-'+pod.id+'">' +
                                        '   <a id="pod-delete-link-'+pod.id+'" data-toggle="modal" data-target="#podDeleteModal" class="btn btn-outline-pink"  role="button" onclick="updateDeletePodModal(\''+pod.name+'\', \''+pod.id+'\');" ><i class="fa fa-minus"></i> Delete</a>' +
                                        '</div>');
                            }

                        }





                    });


                }
            });

        });

    </script>


@endpush