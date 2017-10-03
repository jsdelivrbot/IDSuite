@extends('layouts.medsitter')

@section('content')

    <div class="row mt-2">

        <div class="col-lg-5" style="margin-left: 3.75%;">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus-0">Initializing</span>
                <span id="clientVersion-0"></span>
                {{--<div id="renderer" class="card-img-top rendererWithOptions pluginOverlay mt-2" style="height: 275px;"></div>--}}

                <div id="renderer2-0" class="card-img-top mt-2"> </div>

                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-0" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton-0" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton-0" title="Join Conference" class="toolbarButton callStart"></button>
                            {{--<button id="joinLeaveButton-0" title="Join Conference" class="toolbarButton callStart" onclick="startVidyo(0)"></button>--}}
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                        <div id="patient-0">

                        </div>

                        <div id="error-0"></div>
                    </div>

                </div>
            </div>
        </div>

        @php

            $vidyo = new \App\Http\Controllers\VidyoController();

        @endphp

        <div class="col-lg-1">
            <input type="text" id="host" value="{{$vidyo->getHostId()}}" style="margin-left: -27px">
            <input type="text" id="token" placeholder="" value="{{$vidyo->getToken()}}" style="margin-left: -27px">
            <input id="resourceId" type="text" value="IDSRoom" style="margin-left: -27px">
            <input id="displayName" type="text" value="{{$sitter->first_name . ' ' . $sitter->last_name}}" style="margin-left: -27px">
            <div id="error"></div>


            <div id="participants" class="mt-4 col-lg-6 text-white">

            </div>

        </div>

        <div class="col-lg-5">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus-1">Initializing</span>
                <span id="clientVersion-1"></span>
                <div id="renderer2-1" class="card-img-top mt-2"> </div>
                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-1" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton-1" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton-1" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
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

        <div class="col-lg-5" style="margin-left: 3.75%;">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus-2">Initializing</span>
                <span id="clientVersion-2"></span>
                <div id="renderer2-2" class="card-img-top mt-2"> </div>
                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-2" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton-2" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton-2" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                        <div id="patient-2">

                        </div>
                        <div id="error-2"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-1">

        </div>

        <div class="col-lg-5">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus-3">Initializing</span>
                <span id="clientVersion-3"></span>
                <div id="renderer2-3" class="card-img-top mt-2"> </div>
                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton-3" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton-3" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton-3" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                        <div id="patient-3">

                        </div>
                        <div id="error-3"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>






@endsection


@push('medsitter_sitter')


    <script type="text/javascript">


        function onVidyoClientLoaded(status, patientnumber = 0) {


//        function startVidyo(status, patientnumber){

            console.log("Status: " + status.state + "Description: " + status.description);

            let connectionstatus = $("#connectionStatus");

            switch (status.state) {
                case "READY":    // The library is operating normally
                    connectionstatus.html("Ready to Connect");
                    $("#helper").addClass("hidden");
                    // After the VidyoClient is successfully initialized a global VC object will become available
                    // All of the VidyoConnector gui and logic is implemented in VidyoConnector.js
//                    StartVidyoConnector(VC, patientnumber);
                    StartVidyoConnector(VC, patientnumber);
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


        function loadHelperOptions() {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            // Opera 8.0+
            var isOpera = (userAgent.indexOf("Opera") || userAgent.indexOf('OPR')) != -1 ;
            // Firefox
            var isFirefox = userAgent.indexOf("Firefox") != -1;
            // Chrome 1+
            var isChrome = userAgent.indexOf("Chrome") != -1;
            // Safari
            var isSafari = !isChrome && userAgent.indexOf("Safari") != -1;
            // AppleWebKit
            var isAppleWebKit = !isSafari && !isChrome && userAgent.indexOf("AppleWebKit") != -1;
            // Internet Explorer 6-11
            var isIE = (userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true );
            // Edge 20+
            var isEdge = !isIE && !!window.StyleMedia;
            // Check if Mac
            var isMac = navigator.platform.indexOf('Mac') > -1;
            // Check if Windows
            var isWin = navigator.platform.indexOf('Win') > -1;
            // Check if Linux
            var isLinux = navigator.platform.indexOf('Linux') > -1;
            // Check if Android
            var isAndroid = userAgent.indexOf("android") > -1;
            // Check if WebRTC is available
            var isWebRTCAvailable = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || (navigator.mediaDevices ? navigator.mediaDevices.getUserMedia : undefined);


            if (!isMac && !isWin && !isLinux) {
                /* Mobile App*/
                if (isAndroid) {
                    $("#joinViaApp").removeClass("hidden");
                } else {
                    $("#joinViaOtherApp").removeClass("hidden");
                }
                if (isWebRTCAvailable) {
                    /* Supports WebRTC */
                    $("#joinViaBrowser").removeClass("hidden");
                }
            } else {
                /* Desktop App */
                $("#joinViaApp").removeClass("hidden");

                if (isWebRTCAvailable) {
                    /* Supports WebRTC */
                    $("#joinViaBrowser").removeClass("hidden");
                }
                if (isSafari || isFirefox || (isAppleWebKit && isMac) || (isIE && !isEdge)) {
                    /* Supports Plugins */
                    $("#joinViaPlugIn").removeClass("hidden");
                }
            }
        }

        // Runs when the page loads
        $(function() {
            joinViaBrowser();
        });
    </script>


    <script type="text/javascript">

        console.log('pusher');

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

                $('#patient-' + key).empty();

                $('#patient-' + key).append('<div><span>Id: '+p.id+'</span></div><div><span>Name: '+p.first_name +' '+ p.last_name +'</span></div><div><span>Type: '+type+'</span></div><div><span>Muted: '+muted+'</span></div>');

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
        });
    </script>


    <script type="text/javascript">

        let patient_count = 0;

        Echo.private('medsitter-pod-key')
            .listen('PodKey', event => {

                let token = event.token;

                let roomkey = event.room_key;

                let podid = event.pod_id;

                if (podid === "{{$pod->id}}"){
                    $('#token').val(token);
                    $('#resourceId').val(roomkey);

                    let status = {
                        state: "READY",
                        description: "WebRTC successfully loaded"
                    };

                    onVidyoClientLoaded(status, patient_count);

                    patient_count++;
                }

                console.log(token);
                console.log(roomkey);
                console.log(podid);

            });

    </script>

@endpush