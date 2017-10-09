@extends('layouts.medsitter')

@section('content')

    <div class="row mt-2">

        <div class="col-lg-11" style="margin-left: 3.75%;">
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
                            {{--<button id="cameraButton" title="Camera Privacy" class="toolbarButton cameraOn"></button>--}}
                            <button id="joinLeaveButton-0" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

        @php

            $vidyo = new \App\Http\Controllers\VidyoController();

        @endphp

        <div class="col-lg-6 offset-4">
            <input type="text" id="host" value="{{$vidyo->getHostId()}}">
            <input type="text" id="token" placeholder="" value="{{$vidyotoken}}">
            <input id="resourceId" type="text" value="{{$room}}">
            <input id="displayName" type="text" value="{{$participant->first_name . ' ' . $participant->last_name}}">
            <div id="error"></div>
        </div>

    <div class="row">
        <div class="mt-4 col-lg-6 text-white">

            <span>Name: </span><span id="participant-name"></span>
            <span>Type: </span><span id="participant-type"></span>
            <span>Muted: </span><span id="participant-muted"></span>

        </div>
    </div>




@endsection


@push('medsitter_patient')




    <script type="text/javascript">



        function onVidyoClientLoaded(status) {
            console.log("Status: " + status.state + "Description: " + status.description);

            let connectionstatus = $("#connectionStatus");

            switch (status.state) {
                case "READY":    // The library is operating normally
                    connectionstatus.html("Ready to Connect");
                    $("#helper").addClass("hidden");
                    // After the VidyoClient is successfully initialized a global VC object will become available
                    // All of the VidyoConnector gui and logic is implemented in VidyoConnector.js
                    StartVidyoConnector(VC, 0);
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

        let participant;

        Echo.private('medsitter-call-status')
            .listen('EventCallStatus', event => {
                participant = event.participant;
            });


        Echo.private('medsitter-mute-toggle')
            .listen('MutePatient', event => {

                let roomkey = event.room_key;

                console.log(roomkey);


                if(roomkey === "{{$pod->id . '-' . $participant->id}}"){
                    muteSpeakers(0);

                    console.log('speakers mute toggled');
                } else{
                    console.log('speakers mute toggled FAILED: Room keys are not equal.');
                }

            });




    </script>



    <script type="text/javascript">

        let only_once = true;

        $(window).on("beforeunload", function() {

            if(only_once) {
                only_once = false;
                $.ajax({
                    url: "/medsitter/participant/leave",
                    type: "POST",
                    data: {
                        "participant_id": "{{$participant->id}}",
                        "pod_id": "{{$pod->id}}"
                    }
                });
            }
        });
    </script>

@endpush