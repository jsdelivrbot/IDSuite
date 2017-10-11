@extends('layouts.medsitter')

@section('content')


    <section class="row mt-5">

        <div class="col-lg-8" style="margin-left: 3.75%;">

            <div class="card text-white" style="background-color: transparent;border: none">
                <div class="card-block">
                    <h1 class="card-title" style="border: none;">Pod Dashboard</h1>

                    <div class="card-text ml-5">
                        Account is enabled up-to 4 patients
                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-3">
            <div id="pod-chart" style="height: 400px;"></div>
        </div>

    </section>

    <div id="pods">

    @foreach($pods as $pod)

            <div class="row mt-2">
                <div class="col-lg-11" style="margin-left: 3.75%;">
                    <div class="card" style="background-color: #434857 !important">
                        <div class="card-block text-white" style="padding: 8px;">
                            <div class="row">
                                <div class="col-lg-1 align-self-center">

                                    @if($pod->patient_count < 4 && $pod->sitter_count > 0)
                                        <a id="pod-patient-link-{{$pod->id}}" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal"  role="button" onclick="changeSubmit('{{$pod->id}}')">Patient</a>
                                    @else
                                        <a id="pod-patient-link-{{$pod->id}}" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal disabled" role="button" onclick="changeSubmit('{{$pod->id}}')">Patient</a>
                                    @endif

                                </div>
                                <div class="col-lg-1 align-self-center ml-3">
                                    <a id="pod-sitter-link-{{$pod->id}}" class="btn btn-outline-orange" href="/medsitter/sitter/{{$pod->id}}" role="button">Sitter</a>
                                </div>
                                <div class="col-lg-3 align-self-center">
                                    <div class="ml-5 ">
                                        <span id="pod-name-{{$pod->id}}">{{$pod->name}}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 align-self-center">
                                    <div class="progress">
                                        <div id="pod-participant-count-{{$pod->id}}" class="progress-bar" role="progressbar" style="width: {{100*($pod->patient_count/4)}}%" aria-valuenow="{{100*($pod->patient_count/4)}}%" aria-valuemin="0" aria-valuemax="100">{{$pod->patient_count}}/4</div>
                                    </div>
                                </div>

                                <div class="col-lg-3 align-self-center">
                                    <span id="pod-sitter-count-{{$pod->id}}">{{$pod->sitter_count}} Sitter(s)</span>
                                    <span id="pod-patient-count-{{$pod->id}}">{{$pod->patient_count}} Patient(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <!-- Start Form-->
        <div class="modal" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="patientModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Contact</h5>
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
                        <a id="patient-submit" value="" class="btn btn-nav-orange" style="cursor: pointer !important;"><i class="fa fa-plus"></i>Submit</a>
                    </div>
                </div>
            </div>
        </div>
        <!--End Form-->
    @endforeach
    </div>


@endsection


@push('medsitter_library')
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/gauge.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>

    <script type="text/javascript">

        console.log('pusher');

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
                .text(pod.sitter_count + " Sitter(s)");

            $('#pod-patient-count-' + pod.id)
                .text(pod.patient_count + " Patient(s)");


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
                '                               <div class="row">' +
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
                '                                   <div class="col-lg-3 align-self-center">' +
                '                                       <span id="pod-sitter-count-'+pod.id+'">'+pod.sitter_count+' Sitter(s)</span>' +
                '                                       <span id="pod-patient-count-'+pod.id+'">'+pod.patient_count+' Patient(s)</span>' +
                '                                   </div>' +
                '                               </div>' +
                '                           </div>' +
                '                       </div>' +
                '                   </div>' +
                '               </div>' +
                '');

            if(pod.patient_count < 4 && pod.sitter_count > 0){
                $('#patient-links-'+pod.id).append('<a id="pod-patient-link-'+pod.id+'" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal"  role="button" onclick="changeSubmit(\''+pod.id+'\')">Patient</a>');
            } else {
                $('#patient-links-'+pod.id).append('<a id="pod-patient-link-'+pod.id+'" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal disabled" role="button" onclick="changeSubmit(\''+pod.id+'\')">Patient</a>')
            }

        }

        function changeSubmit(podId) {
            $('#patient-submit').attr('value', podId);

            console.log("changed paitent-submit");

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
                    type: "patient"
                },
                success: function (data) {
                    // add note dynamically to note list //
                    window.location.href = '/medsitter/patient/'+podid+'-'+data.participant_id;
                }
            });
        });
    </script>


@endpush