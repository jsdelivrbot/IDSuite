@extends('layouts.medsitter')

@section('content')

    <div class="row mt-2">

        <div class="col-lg-6">
            <div class="card" style="background-color: #434857 !important">
                <div class="card-block">
                    <span id="connectionStatus-0">Initializing</span>
                    <span id="clientVersion-0"></span>

                    <div id="renderer2-0" class="card-img-top mt-2"> </div>



                    <div id="patient-connect-buttons-0" class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="join-sms-0" title="Join by SMS" class="toolbarButton joinsms" onclick="showSmsInput(0)"></button>
                            <button class="toolbarButton" onclick="showCode(0)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                        </div>
                    </div>

                    <div id="patient-sms-connect-form-0" class="form-group d-none">
                        <div class="input-group justify-content-center">
                                <input type="tel" class="form-control" id="sms-join-number-0" aria-describedby="Phone Number" placeholder="Enter 10 digit number...">
                            <button id="join-sms-0" title="Join by SMS" class="toolbarButton joinsms"></button>
                            <button id="cancel-sms-0" title="Join by SMS" class="toolbarButton" onclick="hideSmsInpute(0)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>


                    <div id="patient-code-connect-form-0" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <input class="form-control" id="code-number-0" disabled>
                            <button id="join-code-0" title="Join by Code" class="toolbarButton" onclick="generateCode(0)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                            <button id="cancel-code-0" title="Join by Code" class="toolbarButton" onclick="hideCode(0)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>


                    <div id="patient-video-buttons-0" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-0" title="Microphone Privacy" class="toolbarButton microphoneOff"></button>
                            <button id="joinLeaveButton-0" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="toolbarButton"><i class="fa fa-camera fa-3x"></i></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>

                        </div>
                        <div id="patient-0">
                        </div>

                        <div id="error-0"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card" style="background-color: #434857 !important">
                <div class="card-block">
                    <span id="connectionStatus-1">Initializing</span>
                    <span id="clientVersion-1"></span>

                    <div id="renderer2-1" class="card-img-top mt-2"> </div>



                    <div id="patient-connect-buttons-1" class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="join-sms-1" title="Join by SMS" class="toolbarButton joinsms" onclick="showSmsInput(1)"></button>
                            <button class="toolbarButton" onclick="showCode(1)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                        </div>
                    </div>

                    <div id="patient-sms-connect-form-1" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <input type="tel" class="form-control" id="sms-join-number-1" aria-describedby="Phone Number" placeholder="Enter 10 digit number...">
                            <button id="join-sms-1" title="Join by SMS" class="toolbarButton joinsms"></button>
                            <button id="cancel-sms-1" title="Join by SMS" class="toolbarButton" onclick="hideSmsInpute(1)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>

                    <div id="patient-code-connect-form-1" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <input class="form-control" id="code-number-1" disabled>
                            <button id="join-code-1" title="Join by Code" class="toolbarButton" onclick="generateCode(1)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                            <button id="cancel-code-1" title="Join by Code" class="toolbarButton" onclick="hideCode(1)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>

                    <div id="patient-video-buttons-1" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-1" title="Microphone Privacy" class="toolbarButton microphoneOff"></button>
                            <button id="joinLeaveButton-1" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="toolbarButton"><i class="fa fa-camera fa-3x"></i></button>
                            <button class="btn btn-nav-blue my-2 my-sm-1" type="button">Details</button>

                        </div>
                        <div id="patient-1">

                        </div>
                        <div id="error-1"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row mt-3">

        <div class="col-lg-6">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus-2">Initializing</span>
                <div class="card-block">

                    <span id="clientVersion-2"></span>

                    <div id="renderer2-2" class="card-img-top mt-2"> </div>



                    <div id="patient-connect-buttons-2" class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="join-sms-2" title="Join by SMS" class="toolbarButton joinsms" onclick="showSmsInput(2)"></button>
                            <button class="toolbarButton" onclick="showCode(2)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                        </div>
                    </div>

                    <div id="patient-sms-connect-form-2" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <input type="tel" class="form-control" id="sms-join-number-2" aria-describedby="Phone Number" placeholder="Enter 10 digit number...">
                            <button id="join-sms-2" title="Join by SMS" class="toolbarButton joinsms"></button>
                            <button id="cancel-sms-2" title="Join by SMS" class="toolbarButton" onclick="hideSmsInpute(2)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>

                    <div id="patient-code-connect-form-2" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <input class="form-control" id="code-number-2" disabled>
                            <button id="join-code-2" title="Join by Code" class="toolbarButton" onclick="generateCode(2)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                            <button id="cancel-code-2" title="Join by Code" class="toolbarButton" onclick="hideCode(2)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>

                    <div id="patient-video-buttons-2" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-2" title="Microphone Privacy" class="toolbarButton microphoneOff"></button>
                            <button id="joinLeaveButton-2" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="toolbarButton"><i class="fa fa-camera fa-3x"></i></button>
                            <button class="btn btn-nav-blue my-2 my-sm-2" type="button">Details</button>

                        </div>
                        <div id="patient-2">

                        </div>
                        <div id="error-2"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color: #434857 !important">

                <span id="connectionStatus-3">Initializing</span>
                <div class="card-block">

                    <span id="clientVersion-3"></span>

                    <div id="renderer2-3" class="card-img-top mt-2"> </div>



                    <div id="patient-connect-buttons-3" class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="join-sms-3" title="Join by SMS" class="toolbarButton joinsms" onclick="showSmsInput(3)"></button>
                            <button class="toolbarButton" onclick="showCode(3)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                        </div>
                    </div>

                    <div id="patient-sms-connect-form-3" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <input type="tel" class="form-control" id="sms-join-number-3" aria-describedby="Phone Number" placeholder="Enter 10 digit number...">
                            <button id="join-sms-3" title="Join by SMS" class="toolbarButton joinsms"></button>
                            <button id="cancel-sms-3" title="Join by SMS" class="toolbarButton" onclick="hideSmsInpute(3)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>

                    <div id="patient-code-connect-form-3" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <input class="form-control" id="code-number-3" disabled>
                            <button id="join-code-3" title="Join by Code" class="toolbarButton" onclick="generateCode(3)"><i class="fa fa-code fa-3x" aria-hidden="true" style="color: white;"></i></button>
                            <button id="cancel-code-3" title="Join by Code" class="toolbarButton" onclick="hideCode(3)"><i class="fa fa-times fa-3x" style="color: red;"></i></button>
                        </div>
                    </div>

                    <div id="patient-video-buttons-3" class="form-group d-none">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-3" title="Microphone Privacy" class="toolbarButton microphoneOff"></button>
                            <button id="joinLeaveButton-3" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="toolbarButton"><i class="fa fa-camera fa-3x"></i></button>
                            <button class="btn btn-nav-blue my-2 my-sm-3" type="button">Details</button>

                        </div>
                        <div id="patient-3">

                        </div>
                        <div id="error-3"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="row mt-4">
        <div class="col-lg-5">

        </div>
        <div class="col-lg-2 text-center">
            <small class="text-white">MedSitter © Copyright 2017</small>

            <div>
                <button class="btn btn-nav-blue btn-sm my-2 my-sm-0" onclick="$('#medsitter-copyright-modal').modal('toggle')">Details</button>
            </div>

        </div>
        <div class="col-lg-5">

        </div>
    </div>


    <!-- Start Form-->
    <div class="modal" id="medsitter-copyright-modal" tabindex="-1" role="dialog" aria-labelledby="medsitter-copyright-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Copyright -- Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>MedSitter</h4>
                    <span>
                        © Copyright 2017 -Interactive Digital Solutions, Inc; All Rights Reserved The MedSitter brand is trademarked by Interactive Digital Solutions. All other products or brand names are trademarks of their respective holders.
                    </span>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Form-->

    <!-- Start Form-->
    <div class="modal" id="patient-joining-modal" tabindex="-1" role="dialog" aria-labelledby="patient-joining-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Patient Joining</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <span>First Name: </span><span id="join-first-name"></span>
                    </div>
                    <div>
                        <span>Last Name: </span><span id="join-last-name"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="patient-join-cancel" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Cancel</a>
                    <a id="patient-join-submit" class="btn btn-nav-orange" style="cursor: pointer !important;">Admit Patient</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Form-->


    <div class="modal" id="invalid-code-modal" tabindex="-1" role="dialog" aria-labelledby="invalid-code-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invalid Code Used</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        The patient was unable to join due to using an invalid code upon connection. The code used was <span id="invalid-code"></span>
                    </span>
                </div>
                <div class="modal-footer">
                    <a id="invalid-code-close" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                </div>
            </div>
        </div>
    </div>


    @php

        $vidyo = new \App\Http\Controllers\VidyoController();

    @endphp

    <div class="invisible">
        <input type="text" id="host" value="{{$vidyo->getHostId()}}" style="margin-left: -27px">
        <input type="text" id="token" placeholder="" value="{{$vidyo->getToken()}}" style="margin-left: -27px">
        <input id="resourceId" type="text" value="IDSRoom" style="margin-left: -27px">
        <input id="displayName" type="text" value="{{$sitter->first_name . ' ' . $sitter->last_name}}" style="margin-left: -27px">
        <div id="error"></div>

        <div id="participants" class="mt-4 col-lg-6 text-white">

        </div>

    </div>

@endsection


@push('medsitter_sitter')


    <script type="text/javascript">

        function onVidyoClientLoaded(status, count) {
            console.log("Status: " + status.state + " Description: " + status.description);

            let connectionstatus = $("#connectionStatus");

            switch (status.state) {
                case "READY":    // The library is operating normally
                    connectionstatus.html("Ready to Connect");
                    $("#helper").addClass("hidden");
                    // After the VidyoClient is successfully initialized a global VC object will become available
                    // All of the VidyoConnector gui and logic is implemented in VidyoConnector.js
                    StartVidyoConnector(VC, count);


                    break;
                case "RETRYING": // The library operating is temporarily paused
                    connectionstatus.html("Temporarily unavailable retrying in " + status.nextTimeout/1000 + " seconds");
                    break;
                case "FAILED":   // The library operating has stopped
                    ShowFailed(status);
                    connectionstatus.html("Failed: " + status.description);
                    break;
                case "FAILEDVERSION":   // The library operating has stopped
                    UpdateHelperPaths(status);
                    ShowFailedVersion(status);
                    connectionstatus.html("Failed: " + status.description);
                    break;
                case "NOTAVAILABLE": // The library is not available
                    UpdateHelperPaths(status);
                    connectionstatus.html(status.description);
                    break;
            }
            return true; // Return true to reload the plugins if not available
        }
        function UpdateHelperPaths(status) {
            $("#helperPlugInDownload").attr("href", status.downloadPathPlugIn);
            $("#helperAppDownload").attr("href", status.downloadPathApp);
        }
        function ShowFailed(status) {
            var helperText = '';
            // Display the error
            helperText += '<h2>An error occurred, please reload</h2>';
            helperText += '<p>' + status.description + '</p>';

            $("#helperText").html(helperText);
            $("#failedText").html(helperText);
            $("#failed").removeClass("hidden");
        }
        function ShowFailedVersion(status) {
            var helperText = '';
            // Display the error
            helperText += '<h4>Please Download a new plugIn and restart the browser</h4>';
            helperText += '<p>' + status.description + '</p>';

            $("#helperText").html(helperText);
        }

        function loadVidyoClientLibrary(webrtc, plugin) {
            // If webrtc, then set webrtcLogLevel
            var webrtcLogLevel = "";
            if (webrtc) {
                // Set the WebRTC log level to either: 'info' (default), 'error', or 'none'
                webrtcLogLevel = '&webrtcLogLevel=none';
            }

            //We need to ensure we're loading the VidyoClient library and listening for the callback.
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://static.vidyo.io/4.1.16.8/javascript/VidyoClient/VidyoClient.js?onload=onVidyoClientLoaded&webrtc=' + webrtc + '&plugin=' + plugin + webrtcLogLevel;
            document.getElementsByTagName('head')[0].appendChild(script);
        }
        function joinViaBrowser() {
            $("#helperText").html("Loading...");
            $("#helperPicker").addClass("hidden");
            $("#monitorShareParagraph").addClass("hidden");
            loadVidyoClientLibrary(true, false);
        }

        // Runs when the page loads
        $(function() {
            joinViaBrowser();
        });
    </script>


    <script type="text/javascript">

        console.log('pusher');

        let joining_patient;

        Echo.private('medsitter-participant-join')
            .listen('EventParticipantJoin', event => {
                joining_patient = event.participant;

                if(event.code !== null){

                    console.log('event.code not null');



                    $.ajax({
                        url: "/api/getPod",
                        type: "GET",
                        data: {
                            "pod_id": "{{$pod->id}}"
                        },
                        success: function(pod){

                            if(pod.code === event.code){

                                console.log('pod.code and event.code ===');

                                $('#join-first-name').text(joining_patient.first_name);
                                $('#join-last-name').text(joining_patient.last_name);

                                $('#patient-joining-modal').modal('toggle');

                            } else {


                                // TODO this needs to be removed //

                                console.log('joininvalid');

                                $('#invalid-code').text(event.code);

                                $('#invalid-code-modal').modal("toggle");

                                $.ajax({
                                    url: "/medsitter/sitter/joininvalid",
                                    type: "GET",
                                    data: {
                                        "pod_id": "{{$pod->id}}",
                                        "participant_id": event.participant.id,
                                        "code": event.code
                                    },
                                    success: function(code){


                                        console.log('joininvalid');

                                        $('#invalid-code').text(code);

                                        $('#invalid-code-modal').modal("toggle");

                                    }
                                });

                            }
                        }
                    });
                }
            });

        Echo.private('medsitter-patient-ready')
            .listen('EventPatientReady', event => {

                let roomkey = event.roomkey;

                let count = patient_count - 1;

                console.log('trigger join: ' + count);

                $('#patient-connect-buttons-' + count).addClass("d-none");

                $('#patient-sms-connect-form-' + count).addClass("d-none");

                $('#patient-code-connect-form-' + count).addClass("d-none");

                $('#joinLeaveButton-' + count).trigger('click');

            });



        $('#patient-join-submit').click(function(){

            $.ajax({
                url: "/medsitter/patient/join",
                type: "GET",
                data: {
                    "pod_id": "{{$pod->id}}",
                    "patient_id": joining_patient.id
                }
            });

            $('#patient-joining-modal').modal('toggle');

        });

        let participants = [];

        Echo.private('medsitter-call-status')
            .listen('EventCallStatus', event => {
                participants.push(event.participant);
                updateValues();
            });


        function updateValues (){

            let type, muted;

            console.log('test');

            $.each(participants, function(key){

                let p = participants[key];

                if(p.type === 0){
                    type = 'sitter';
                } else if (p.type === 1){
                    type = 'patient';
                } else {
                    type = 'unkown';
                }

                if(p.muted === 0){
                    muted = 'false';
                } else {
                    muted = 'true';
                }
//
//                $('#patient-' + key).empty();
//
//                $('#patient-' + key).append('<div><span>Id: '+p.id+'</span></div><div><span>Name: '+p.first_name +' '+ p.last_name +'</span></div><div><span>Type: '+type+'</span></div><div><span>Muted: '+muted+'</span></div>');

                $('#patient-video-buttons-' + key).removeClass("d-none");

                $('#patient-connect-buttons-' + key).addClass("d-none");

                $('#patient-sms-connect-form-' + key).addClass("d-none");

                $('#microphoneButton-' + key).attr('onclick', "muteToggle("+JSON.stringify(p)+", '"+key+"')");

            });



        }

    </script>


    <script type="text/javascript">

        let only_once = true;


        $(window).on("beforeunload", function() {
            if(only_once) {
                only_once = false;
                $.ajax({
                    url: "/medsitter/sitter/leave",
                    type: "POST",
                    data: {
                        "sitter_id": "{{$sitter->id}}",
                        "pod_id": "{{$pod->id}}"
                    }
                });
            }

            return "Are you sure you want to leave? The session will die!";
        });
    </script>


    <script type="text/javascript">

        let patient_count = 0;

        let patient_array = [];

        Echo.private('medsitter-pod-key')
            .listen('PodKey', event => {

                let patient_obj = {
                    "token" : event.token,
                    "roomkey" : event.room_key,
                    "podid" : event.pod_id
                };

                console.log(event.room_key);

                if (patient_obj.podid === "{{$pod->id}}"){
                    $('#token').val(patient_obj.token);
                    $('#resourceId').val(patient_obj.roomkey);

                    let status = {
                        state: "READY",
                        description: "WebRTC successfully loaded"
                    };

                    patient_obj.patient_number = patient_count;

                    StartVidyoConnector(VC, patient_count);

                    patient_array.push(patient_obj);

                    patient_count++;

                }
                console.log(patient_obj);
            });


        function generateCode(id){

            $.ajax({
                url: "/medsitter/sitter/generateCode",
                type: "POST",
                data: {
                    "pod_id": "{{$pod->id}}"
                },
                success: function (code) {

                    console.log(code);

                    $('#code-number-' + id).val(code);

                }
            });

        }


        function showSmsInput(id){
            $('#patient-connect-buttons-' + id).addClass('d-none');
            $('#patient-sms-connect-form-' + id).removeClass('d-none');
        }

        function hideSmsInpute(id){
            $('#patient-sms-connect-form-' + id).addClass('d-none');
            $('#patient-connect-buttons-' + id).removeClass('d-none');
        }

        function showCode(id){
            $('#patient-connect-buttons-' + id).addClass('d-none');
            $('#patient-code-connect-form-' + id).removeClass('d-none');
        }

        function hideCode(id){
            $('#patient-code-connect-form-' + id).addClass('d-none');
            $('#patient-connect-buttons-' + id).removeClass('d-none');
        }


        function muteToggle(participant, key) {

            console.log(participant);

            $.ajax({
                url: "/medsitter/participant/mutetoggle",
                type: "GET",
                data: {
                    "participant_id": participant.id,
                    "pod_id": "{{$pod->id}}"
                },
                success: function (participant) {

                    console.log('participant muted: ' + participant.muted);

                    if(participant.muted === true){
                        $('#microphoneButton-' + key).addClass("microphoneOn").removeClass("microphoneOff");
                    } else {
                        $('#microphoneButton-' + key).addClass("microphoneOff").removeClass("microphoneOn");
                    }

                }
            });
        }

    </script>



    <script type="text/javascript">


        const OPEN_REMOTE_SLOT = "-1";

        function ShowRenderer(vidyoConnector, divId) {
            var rndr = document.getElementById(divId);
            vidyoConnector.ShowViewAt(divId, rndr.offsetLeft, rndr.offsetTop, rndr.offsetWidth, rndr.offsetHeight);
        }

        let vidyoConnector;
        let speakerPrivacy = false;
        // Run StartVidyoConnector when the VidyoClient is successfully loaded
        function StartVidyoConnector(VC, patientnumber = -1) {

            console.log('start vidyo connector');

            // var vidyoConnector;
            var cameras = {};
            var microphones = {};
            var speakers = {};
            var selectedLocalCamera = {id: 0, camera: null};
            var cameraPrivacy = false;
            var microphonePrivacy = false;
            // var speakerPrivacy = false;
            var remoteCameras = {};
            var configParams = {};

            // rendererSlots[0] is used to render the local camera;
            // rendererSlots[1] through rendererSlots[5] are used to render up to 5 cameras from remote participants.
            var rendererSlots = ["2", "", OPEN_REMOTE_SLOT, OPEN_REMOTE_SLOT, OPEN_REMOTE_SLOT, OPEN_REMOTE_SLOT];

            window.onresize = function() {
                showRenderers(patientnumber);
            };

            VC.CreateVidyoConnector({
                viewId: null, // Set to null in order to create a custom layout
                viewStyle: "VIDYO_CONNECTORVIEWSTYLE_Default", // Visual style of the composited renderer
                remoteParticipants: 15,     // Maximum number of participants to render
                logFileFilter: "warning info@VidyoClient info@VidyoConnector",
                logFileName: "VidyoConnector.log",
                userData: 0
            }).then(function(vc) {
                vidyoConnector = vc;
                parseUrlParameters(configParams, patientnumber);
                registerDeviceListeners(vidyoConnector, cameras, microphones, speakers, rendererSlots, selectedLocalCamera, remoteCameras, patientnumber);
                handleDeviceChange(vidyoConnector, cameras, microphones, speakers);
                handleParticipantChange(vidyoConnector, rendererSlots, remoteCameras, patientnumber);

                // Populate the connectionStatus with the client version
                vidyoConnector.GetVersion().then(function(version) {
                    $("#clientVersion").html("v " + version);
                }).catch(function() {
                    console.error("GetVersion failed");
                });

                // If enableDebug is configured then enable debugging
                if (configParams.enableDebug === "1") {
                    vidyoConnector.EnableDebug({port:7776, logFilter: "warning info@VidyoClient info@VidyoConnector"}).then(function() {
                        console.log("EnableDebug success");
                    }).catch(function() {
                        console.error("EnableDebug failed");
                    });
                }

                // Join the conference if the autoJoin URL parameter was enabled
                if (configParams.autoJoin === "1") {
                    joinLeave();
                } else {
                    // Handle the join in the toolbar button being clicked by the end user.
                    $("#joinLeaveButton-"+patientnumber).one("click", joinLeave);
                }
            }).catch(function(err) {
                console.error("CreateVidyoConnector Failed " + err);
            });

            // Handle the camera privacy button, toggle between show and hide.
            $("#cameraButton-"+patientnumber).click(function() {
                // CameraPrivacy button clicked
                cameraPrivacy = !cameraPrivacy;

                vidyoConnector.SetCameraPrivacy({
                    privacy: cameraPrivacy
                }).then(function() {
                    if (cameraPrivacy) {
                        // Hide the local camera preview, which is in slot 0
                        $("#cameraButton-"+patientnumber).addClass("cameraOff").removeClass("cameraOn");
                        vidyoConnector.HideView({ viewId: "renderer0" }).then(function() {
                            console.log("HideView Success");
                        }).catch(function(e) {
                            console.log("HideView Failed");
                        });
                    } else {
                        // Show the local camera preview, which is in slot 0
                        $("#cameraButton-"+patientnumber).addClass("cameraOn").removeClass("cameraOff");
                        vidyoConnector.AssignViewToLocalCamera({
                            viewId: "renderer0",
                            localCamera: selectedLocalCamera.camera,
                            displayCropped: true,
                            allowZoom: false
                        }).then(function() {
                            console.log("AssignViewToLocalCamera Success");
                            ShowRenderer(vidyoConnector, "renderer0");
                        }).catch(function(e) {
                            console.log("AssignViewToLocalCamera Failed");
                        });
                    }
                    console.log("SetCameraPrivacy Success");
                }).catch(function() {
                    console.error("SetCameraPrivacy Failed");
                });

                vidyoConnector.Enable();
            });



//            function muteSpeakers(){
//
//                console.log('muteSpeakers');
//
//                speakerPrivacy = !speakerPrivacy;
//
//                vidyoConnector.SetSpeakerPrivacy({
//                    privacy: speakerPrivacy
//                }).then(function(result) {
//
//                    console.log('result: ' + result);
//
//                    if (speakerPrivacy) {
//                        $("#microphoneButton-"+patientnumber).addClass("microphoneOff").removeClass("microphoneOn");
//                    } else {
//                        $("#microphoneButton-"+patientnumber).addClass("microphoneOn").removeClass("microphoneOff");
//                    }
//                    console.log("SetSpeakerPrivacy Success");
//                }).catch(function(result) {
//
//                    console.log('result: ' + result);
//
//                    console.error("SetSpeakerPrivacy Failed");
//                });
//
//            }

            // Handle the microphone mute button, toggle between mute and unmute audio.
//            $("#microphoneButton-" + patientnumber).click(function() {
//
//                console.log('MicbuttonTriggered');
//
//                speakerPrivacy = !speakerPrivacy;
//
//                vidyoConnector.SetSpeakerPrivacy({
//                    privacy: speakerPrivacy
//                }).then(function(result) {
//
//                    console.log('result: ' + result);
//
//                    if (speakerPrivacy) {
//                        $("#microphoneButton-"+patientnumber).addClass("microphoneOff").removeClass("microphoneOn");
//                    } else {
//                        $("#microphoneButton-"+patientnumber).addClass("microphoneOn").removeClass("microphoneOff");
//                    }
//                    console.log("SetSpeakerPrivacy Success");
//                }).catch(function(result) {
//
//                    console.log('result: ' + result);
//
//                    console.error("SetSpeakerPrivacy Failed");
//                });
//            });

            function joinLeave(patient) {
                // join or leave dependent on the joinLeaveButton, whether it
                // contains the class callStart or callEnd.
                if ($("#joinLeaveButton-"+patientnumber).hasClass("callStart")) {

                    $("#connectionStatus-"+patientnumber).html("Connecting...");
                    $("#joinLeaveButton-"+patientnumber).removeClass("callStart").addClass("callEnd");
                    $("#joinLeaveButton-"+patientnumber).prop('title', 'Leave Conference');

                    console.log(vidyoConnector);

                    connectToConference(vidyoConnector, rendererSlots, remoteCameras, configParams, patientnumber);
                } else {
                    $("#connectionStatus-"+patientnumber).html("Disconnecting...");
                    vidyoConnector.Disconnect().then(function() {
                        console.log("Disconnect Success");
                    }).catch(function() {
                        console.error("Disconnect Failure");
                    });
                }
                $("#joinLeaveButton-"+patientnumber).one("click", joinLeave);
            }

            $("#options-"+patientnumber).removeClass("optionsHide");
        }

        function muteSpeakers(){

            speakerPrivacy = !speakerPrivacy;

            vidyoConnector.SetSpeakerPrivacy({
                privacy: speakerPrivacy
            }).then(function(result) {

                console.log('result: ' + result);

                if (speakerPrivacy) {
                    $("#microphoneButton-"+patientnumber).addClass("microphoneOff").removeClass("microphoneOn");
                } else {
                    $("#microphoneButton-"+patientnumber).addClass("microphoneOn").removeClass("microphoneOff");
                }
                console.log("SetSpeakerPrivacy Success");
            }).catch(function(result) {

                console.log('result: ' + result);

                console.error("SetSpeakerPrivacy Failed");
            });

        }

        function registerDeviceListeners(vidyoConnector, cameras, microphones, speakers, rendererSlots, selectedLocalCamera, remoteCameras, patientnumber) {
            // Map the "None" option (whose value is 0) in the camera, microphone, and speaker drop-down menus to null since
            // a null argument to SelectLocalCamera, SelectLocalMicrophone, and SelectLocalSpeaker releases the resource.
            cameras[0]     = null;
            microphones[0] = null;
            speakers[0]    = null;

            // Handle appearance and disappearance of camera devices in the system
            vidyoConnector.RegisterLocalCameraEventListener({
                onAdded: function(localCamera) {
                    // New camera is available
                    $("#cameras").append("<option value='" + window.btoa(localCamera.id) + "'>" + localCamera.name + "</option>");
                    cameras[window.btoa(localCamera.id)] = localCamera;
                },
                onRemoved: function(localCamera) {
                    // Existing camera became unavailable
                    $("#cameras option[value='" + window.btoa(localCamera.id) + "']").remove();
                    delete cameras[window.btoa(localCamera.id)];

                    // If the removed camera was the selected camera, then hide it
                    if(selectedLocalCamera.id === localCamera.id) {
                        vidyoConnector.HideView({ viewId: "renderer0" }).then(function() {
                            console.log("HideView Success");
                        }).catch(function(e) {
                            console.log("HideView Failed");
                        });
                    }
                },
                onSelected: function(localCamera) {
                    // Camera was selected/unselected by you or automatically
                    if(localCamera) {
                        $("#cameras option[value='" + window.btoa(localCamera.id) + "']").prop('selected', true);
                        selectedLocalCamera.id = localCamera.id;
                        selectedLocalCamera.camera = localCamera;

                        // Assign view to selected camera
                        vidyoConnector.AssignViewToLocalCamera({
                            viewId: "renderer0",
                            localCamera: localCamera,
                            displayCropped: true,
                            allowZoom: false
                        }).then(function() {
                            console.log("AssignViewToLocalCamera Success");
                            ShowRenderer(vidyoConnector, "renderer0");
                        }).catch(function(e) {
                            console.log("AssignViewToLocalCamera Failed");
                        });
                    } else {
                        selectedLocalCamera.id = 0;
                        selectedLocalCamera.camera = null;
                    }
                },
                onStateUpdated: function(localCamera, state) {
                    // Camera state was updated
                }
            }).then(function() {
                console.log("RegisterLocalCameraEventListener Success");
            }).catch(function() {
                console.error("RegisterLocalCameraEventListener Failed");
            });

            // Handle appearance and disappearance of microphone devices in the system
            vidyoConnector.RegisterLocalMicrophoneEventListener({
                onAdded: function(localMicrophone) {
                    // New microphone is available
                    $("#microphones").append("<option value='" + window.btoa(localMicrophone.id) + "'>" + localMicrophone.name + "</option>");
                    microphones[window.btoa(localMicrophone.id)] = localMicrophone;
                },
                onRemoved: function(localMicrophone) {
                    // Existing microphone became unavailable
                    $("#microphones option[value='" + window.btoa(localMicrophone.id) + "']").remove();
                    delete microphones[window.btoa(localMicrophone.id)];
                },
                onSelected: function(localMicrophone) {
                    // Microphone was selected/unselected by you or automatically
                    if(localMicrophone)
                        $("#microphones option[value='" + window.btoa(localMicrophone.id) + "']").prop('selected', true);
                },
                onStateUpdated: function(localMicrophone, state) {
                    // Microphone state was updated
                }
            }).then(function() {
                console.log("RegisterLocalMicrophoneEventListener Success");
            }).catch(function() {
                console.error("RegisterLocalMicrophoneEventListener Failed");
            });

            // Handle appearance and disappearance of speaker devices in the system
            vidyoConnector.RegisterLocalSpeakerEventListener({
                onAdded: function(localSpeaker) {
                    // New speaker is available
                    $("#speakers").append("<option value='" + window.btoa(localSpeaker.id) + "'>" + localSpeaker.name + "</option>");
                    speakers[window.btoa(localSpeaker.id)] = localSpeaker;
                },
                onRemoved: function(localSpeaker) {
                    // Existing speaker became unavailable
                    $("#speakers option[value='" + window.btoa(localSpeaker.id) + "']").remove();
                    delete speakers[window.btoa(localSpeaker.id)];
                },
                onSelected: function(localSpeaker) {
                    // Speaker was selected/unselected by you or automatically
                    if(localSpeaker)
                        $("#speakers option[value='" + window.btoa(localSpeaker.id) + "']").prop('selected', true);
                },
                onStateUpdated: function(localSpeaker, state) {
                    // Speaker state was updated
                }
            }).then(function() {
                console.log("RegisterLocalSpeakerEventListener Success");
            }).catch(function() {
                console.error("RegisterLocalSpeakerEventListener Failed");
            });

            vidyoConnector.RegisterRemoteCameraEventListener({
                onAdded: function(camera, participant) {
                    // Store the remote camera for this participant
                    remoteCameras[participant.id] = {camera: camera, isRendered: false};

                    // Scan through the renderer slots and look for an open slot.
                    // If an open slot is found then assign it to the remote camera.
                    for (var i = 1; i < rendererSlots.length; i++) {
                        rendererSlots[i] = participant.id;
                        remoteCameras[participant.id].isRendered = true;
                        vidyoConnector.AssignViewToRemoteCamera({
                            viewId: "renderer2-" + patientnumber,
                            remoteCamera: camera,
                            displayCropped: true,
                            allowZoom: false
                        }).then(function(retValue) {
                            console.log("AssignViewToRemoteCamera " + participant.id + " to slot " + i + " = " + retValue);
                            ShowRenderer(vidyoConnector, "renderer2-" + patientnumber);
                        }).catch(function() {
                            console.log("AssignViewToRemoteCamera Failed");
                            rendererSlots[i] = OPEN_REMOTE_SLOT;
                            remoteCameras[participant.id].isRendered = false;
                        });
                    }
                },
                onRemoved: function(camera, participant) {
                    console.log("RegisterRemoteCameraEventListener onRemoved participant.id : " + participant.id);
                    delete remoteCameras[participant.id];

                    // Scan through the renderer slots and if this participant's camera
                    // is being rendered in a slot, then clear the slot and hide the camera.
                    for (var i = 1; i < rendererSlots.length; i++) {
                        if (rendererSlots[i] === participant.id) {
                            rendererSlots[i] = OPEN_REMOTE_SLOT;
                            console.log("Slot found, calling HideView on renderer" + i);
                            vidyoConnector.HideView({ viewId: "renderer" + (i) }).then(function() {
                                console.log("HideView Success");

                                // If a remote camera is not rendered in a slot, replace it in the slot that was just cleaered
                                for (var id in remoteCameras) {
                                    if (!remoteCameras[id].isRendered) {
                                        rendererSlots[i] = id;
                                        remoteCameras[id].isRendered = true;
                                        vidyoConnector.AssignViewToRemoteCamera({
                                            viewId: "renderer" + (i) + "-" + patientnumber,
                                            remoteCamera: remoteCameras[id].camera,
                                            displayCropped: true,
                                            allowZoom: false
                                        }).then(function(retValue) {
                                            console.log("AssignViewToRemoteCamera " + id + " to slot " + i + " = " + retValue);
                                            ShowRenderer(vidyoConnector, "renderer" + (i) + "-" + patientnumber);
                                        }).catch(function() {
                                            console.log("AssignViewToRemoteCamera Failed");
                                            rendererSlots[i] = OPEN_REMOTE_SLOT;
                                            remoteCameras[id].isRendered = false;
                                        });
                                        break;
                                    }
                                }
                            }).catch(function(e) {
                                console.log("HideView Failed");
                            });
                            break;
                        }
                    }
                },
                onStateUpdated: function(camera, participant, state) {
                    // Camera state was updated
                }
            }).then(function() {
                console.log("RegisterRemoteCameraEventListener Success");
            }).catch(function() {
                console.error("RegisterRemoteCameraEventListener Failed");
            });
        }

        function handleDeviceChange(vidyoConnector, cameras, microphones, speakers) {
            // Hook up camera selector functions for each of the available cameras
            $("#cameras").change(function() {
                // Camera selected from the drop-down menu
                $("#cameras option:selected").each(function() {
                    // Hide the view of the previously selected local camera
                    vidyoConnector.HideView({ viewId: "renderer0" });

                    // Select the newly selected local camera
                    camera = cameras[$(this).val()];
                    vidyoConnector.SelectLocalCamera({
                        localCamera: camera
                    }).then(function() {
                        console.log("SelectCamera Success");
                    }).catch(function() {
                        console.error("SelectCamera Failed");
                    });
                });
            });

            // Hook up microphone selector functions for each of the available microphones
            $("#microphones").change(function() {
                // Microphone selected from the drop-down menu
                $("#microphones option:selected").each(function() {
                    microphone = microphones[$(this).val()];
                    vidyoConnector.SelectLocalMicrophone({
                        localMicrophone: microphone
                    }).then(function() {
                        console.log("SelectMicrophone Success");
                    }).catch(function() {
                        console.error("SelectMicrophone Failed");
                    });
                });
            });

            // Hook up speaker selector functions for each of the available speakers
            $("#speakers").change(function() {
                // Speaker selected from the drop-down menu
                $("#speakers option:selected").each(function() {
                    speaker = speakers[$(this).val()];
                    vidyoConnector.SelectLocalSpeaker({
                        localSpeaker: speaker
                    }).then(function() {
                        console.log("SelectSpeaker Success");
                    }).catch(function() {
                        console.error("SelectSpeaker Failed");
                    });
                });
            });
        }

        function getParticipantName(participant, cb) {
            if (!participant) {
                cb("Undefined");
                return;
            }

            if (participant.name) {
                cb(participant.name);
                return;
            }

            participant.GetName().then(function(name) {
                cb(name);
            }).catch(function() {
                cb("GetNameFailed");
            });
        }

        function handleParticipantChange(vidyoConnector, rendererSlots, remoteCameras, patientnumber) {
            vidyoConnector.RegisterParticipantEventListener({
                onJoined: function(participant) {
                    getParticipantName(participant, function(name) {
                        $("#participantStatus-"+patientnumber).html("" + name + " Joined");
                        console.log("Participant onJoined: " + name);
                    });
                },
                onLeft: function(participant) {
                    getParticipantName(participant, function(name) {
                        $("#participantStatus-"+patientnumber).html("" + name + " Left");
                        console.log("Participant onLeft: " + name);
                    });
                },
                onDynamicChanged: function(participants, cameras) {
                    // Order of participants changed
                },
                onLoudestChanged: function(participant, audioOnly) {
                    getParticipantName(participant, function(name) {
                        $("#participantStatus-"+patientnumber).html("" + name + " Speaking");
                    });

                    // Check if the loudest speaker is being rendered in one of the slots
                    var found = false;
                    for (var i = 1; i < rendererSlots.length; i++) {
                        if (rendererSlots[i] === participant.id) {
                            found = true;
                            break;
                        }
                    }
                    console.log("onLoudestChanged: loudest speaker in rendererSlots? " + found);

                    // First check if the participant's camera has been added to the remoteCameras dictionary
                    if (!(participant.id in remoteCameras)) {
                        console.log("Warning: loudest speaker participant does not have a camera in remoteCameras");
                    }
                    // If the loudest speaker is not being rendered in one of the slots then
                    // hide the slot 1 remote camera and assign loudest speaker to slot 1.
                    else if (!found) {
                        // Set the isRendered flag to false of the remote camera which is being hidden
                        remoteCameras[rendererSlots[1]].isRendered = false;

                        // Assign slot 1 to the the loudest speaker's participant id
                        rendererSlots[1] = participant.id;

                        // Set the isRendered flag to true of the remote camera which has now been rendered
                        remoteCameras[participant.id].isRendered = true;

                        //Hiding the view first, before the AssignViewToRemoteCamera
                        vidyoConnector.HideView({ viewId: "renderer1"}).then(function() {
                            console.log("HideView Success");
                            vidyoConnector.AssignViewToRemoteCamera({
                                viewId: "renderer1",
                                remoteCamera: remoteCameras[participant.id].camera,
                                displayCropped: true,
                                allowZoom: false
                            }).then(function(retValue) {
                                console.log("AssignViewToRemoteCamera " + participant.id + " to slot 1" + " = " + retValue);
                                ShowRenderer(vidyoConnector, "renderer1");
                            }).catch(function() {
                                console.log("AssignViewToRemoteCamera Failed");
                                rendererSlots[1] = OPEN_REMOTE_SLOT;
                                remoteCameras[participant.id].isRendered = false;
                            });
                        }).catch(function(e) {
                            console.log("HideView Failed, loudest speaker not assigned");
                        });
                    }
                }
            }).then(function() {
                console.log("RegisterParticipantEventListener Success");
            }).catch(function() {
                console.err("RegisterParticipantEventListener Failed");
            });
        }

        function parseUrlParameters(configParams) {
            // Fill in the form parameters from the URI
            var host = getUrlParameterByName("host");
            if (host)
//                $("#host").val(host);
            var token = getUrlParameterByName("token");
            if (token)
//                $("#token").val(token);
            var displayName = getUrlParameterByName("displayName");
            if (displayName)
//                $("#displayName").val(displayName);
            var resourceId = getUrlParameterByName("resourceId");
            if (resourceId)
//                $("#resourceId").val(resourceId);
            configParams.autoJoin    = getUrlParameterByName("autoJoin");
            configParams.enableDebug = getUrlParameterByName("enableDebug");
            configParams.hideConfig  = getUrlParameterByName("hideConfig");

            // If the parameters are passed in the URI, do not display options dialog,
            // and automatically connect.
            if (host && token && displayName && resourceId) {
                $("#optionsParameters").addClass("optionsHidePermanent");
            }

            if (configParams.hideConfig=="1") {
                updateRenderers(true);
            }

            return;
        }

        function showRenderers(patientnumber) {
            // ShowRenderer(vidyoConnector, "renderer0");
            // ShowRenderer(vidyoConnector, "renderer1");
            ShowRenderer(vidyoConnector, "renderer2-"+patientnumber);
            // ShowRenderer(vidyoConnector, "renderer3");
            // ShowRenderer(vidyoConnector, "renderer4");
            // ShowRenderer(vidyoConnector, "renderer5");
        }

        function updateRenderers(fullscreen) {
            if (fullscreen) {
                $("#options").addClass("optionsHide");
                // $("#renderer0").css({'position': 'absolute', 'left':  '0%', 'right': '66%', 'top': '0px', 'bottom': '54%',  'width': '34%'});
                // $("#renderer1").css({'position': 'absolute', 'left': '34%', 'right': '33%', 'top': '0px', 'bottom': '54%',  'width': '33%'});
                // $("#renderer2").css({'position': 'absolute', 'left': '67%', 'right':  '0%', 'top': '0px', 'bottom': '54%',  'width': '33%'});
                // $("#renderer3").css({'position': 'absolute', 'left':  '0%', 'right': '66%', 'top': '46%', 'bottom': '60px', 'width': '34%'});
                // $("#renderer4").css({'position': 'absolute', 'left': '34%', 'right': '33%', 'top': '46%', 'bottom': '60px', 'width': '33%'});
                // $("#renderer5").css({'position': 'absolute', 'left': '67%', 'right':  '0%', 'top': '46%', 'bottom': '60px', 'width': '33%'});
            } else {
                $("#options").removeClass("optionsHide");
                // $("#renderer0").css({'position': 'absolute', 'left': '25%', 'right': '0%', 'top': '0px', 'bottom': '60px',  'width': '75%'});
                // $("#renderer1").css({'position': 'absolute', 'width': '0px'});
                // $("#renderer2").css({'position': 'absolute', 'width': '0px'});
                // $("#renderer3").css({'position': 'absolute', 'width': '0px'});
                // $("#renderer4").css({'position': 'absolute', 'width': '0px'});
                // $("#renderer5").css({'position': 'absolute', 'width': '0px'});
            }

            showRenderers();
        }

        // Attempt to connect to the conference
        // We will also handle connection failures
        // and network or server-initiated disconnects.
        function connectToConference(vidyoConnector, rendererSlots, remoteCameras, configParams, patientnumber) {

            console.log("patient number : " + patientnumber);

            // Abort the Connect call if resourceId is invalid. It cannot contain empty spaces or "@".
            if ( $("#resourceId").val().indexOf(" ") != -1 || $("#resourceId").val().indexOf("@") != -1) {
                console.error("Connect call aborted due to invalid Resource ID");
                connectorDisconnected(rendererSlots, remoteCameras, "Disconnected", "", patientnumber);
                $("#error-"+patientnumber).html("<h3>Failed due to invalid Resource ID" + "</h3>");
                return;
            }

            // Clear messages
            $("#error-" + patientnumber).html("");
            $("#message-" + patientnumber).html("<h3 class='blink'>CONNECTING...</h3>");

            console.log('********************VidyoConnecting********************');

            vidyoConnector.Connect({
                // Take input from options form
                host: $("#host").val(),
                token: $("#token").val(),
                displayName: $("#displayName").val(),
                resourceId: $("#resourceId").val(),

                // Define handlers for connection events.
                onSuccess: function() {
                    // Connected
                    console.log("vidyoConnector.Connect : onSuccess callback received");
                    $("#connectionStatus").html("Connected");

                    if (configParams.hideConfig != "1") {
                        updateRenderers(true);
                    }
                    $("#message").html("");
                },
                onFailure: function(reason) {
                    // Failed
                    console.error("vidyoConnector.Connect : onFailure callback received");
                    connectorDisconnected(rendererSlots, remoteCameras, "Failed", "", patientnumber);
                    $("#error").html("<h3>Call Failed: " + reason + "</h3>");
                },
                onDisconnected: function(reason) {
                    // Disconnected
                    console.log("vidyoConnector.Connect : onDisconnected callback received");
                    connectorDisconnected(rendererSlots, remoteCameras, "Disconnected", "Call Disconnected: " + reason, patientnumber);

                    if (configParams.hideConfig != "1") {
                        updateRenderers(false);
                    }
                }
            }).then(function(status) {
                if (status) {
                    console.log("Connect Success");
                } else {
                    console.error("Connect Failed");
                    connectorDisconnected(rendererSlots, remoteCameras, "Failed", "", patientnumber);
                    $("#error").html("<h3>Call Failed" + "</h3>");
                }
            }).catch(function() {
                console.error("Connect Failed");
                connectorDisconnected(rendererSlots, remoteCameras, "Failed", "", patientnumber);
                $("#error").html("<h3>Call Failed" + "</h3>");
            });
        }

        // Connector either fails to connect or a disconnect completed, update UI
        // elements and clear rendererSlots and remoteCameras.
        function connectorDisconnected(rendererSlots, remoteCameras, connectionStatus, message, patientnumber) {
            $("#connectionStatus").html(connectionStatus);
            $("#message").html(message);
            $("#participantStatus").html("");
            $("#joinLeaveButton").removeClass("callEnd").addClass("callStart");
            $('#joinLeaveButton').prop('title', 'Join Conference');

            // Clear rendererSlots and remoteCameras when not connected in case not cleared
            // in RegisterRemoteCameraEventListener onRemoved.
            for (var i = 1; i < rendererSlots.length; i++) {
                if (rendererSlots[i] != OPEN_REMOTE_SLOT) {
                    rendererSlots[i] = OPEN_REMOTE_SLOT;
                    console.log("Calling HideView on renderer" + i);
                    vidyoConnector.HideView({
                        viewId: "renderer" + (i) + "-" + patientnumber
                    }).then(function() {
                        console.log("HideView Success");
                    }).catch(function(e) {
                        console.log("HideView Failed");
                    });
                }
            }
            remoteCameras = {};
        }

        // Extract the desired parameter from the browser's location bar
        function getUrlParameterByName(name) {
            var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
            return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
        }





    </script>


@endpush