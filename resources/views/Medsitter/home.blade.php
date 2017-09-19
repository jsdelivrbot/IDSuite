@extends('layouts.medsitter')

@section('content')

    <div class="row mt-2">

        <div class="col-lg-5" style="margin-left: 3.75%;">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus">Initializing</span>
                <span id="clientVersion"></span>
                <div id="renderer" class="card-img-top rendererWithOptions pluginOverlay mt-2" style="height: 275px;"></div>
                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @php

            $vidyo = new \App\Http\Controllers\VidyoController();

        @endphp

        <div class="col-lg-1">
            <input type="text" id="host" value="{{$vidyo->getAppId()}}" style="margin-left: -27px">
            <input type="text" id="token" placeholder="" value="{{$vidyo->getToken()}}" style="margin-left: -27px">
            <input id="resourceId" type="text" value="IDSRoom" style="margin-left: -27px">
            <input id="displayName" type="text" value="Amac" style="margin-left: -27px">
        </div>

        <div class="col-lg-5">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus">Initializing</span>
                <span id="clientVersion"></span>
                <div id="renderer" class="card-img-top rendererWithOptions pluginOverlay mt-2" style="height: 275px;"></div>
                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row mt-3">

        <div class="col-lg-5" style="margin-left: 3.75%;">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus">Initializing</span>
                <span id="clientVersion"></span>
                <div id="renderer" class="card-img-top rendererWithOptions pluginOverlay mt-2" style="height: 275px;"></div>
                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-1">

        </div>

        <div class="col-lg-5">
            <div class="card" style="background-color: #434857 !important">
                <span id="connectionStatus">Initializing</span>
                <span id="clientVersion"></span>
                <div id="renderer" class="card-img-top rendererWithOptions pluginOverlay mt-2" style="height: 275px;"></div>
                <div class="card-block">

                    {{--<span id="participantStatus"></span>--}}

                    <div class="form-group">
                        <div class="input-group justify-content-center">
                            <button id="microphoneButton" title="Microphone Privacy" class="toolbarButton microphoneOn"></button>
                            <button id="cameraButton" title="Camera Privacy" class="toolbarButton cameraOn"></button>
                            <button id="joinLeaveButton" title="Join Conference" class="toolbarButton callStart"></button>
                            <button class="btn btn-nav-blue my-2 my-sm-0" type="button">Details</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>




    {{--<div class="mt-5">--}}



        {{--<div id="toolbarLeft" class="toolbar">--}}

        {{--</div>--}}

        {{--<div id="toolbarCenter" class="toolbar">--}}
            {{--<!-- This button toggles the camera privacy on or off. -->--}}


            {{--<!-- This button joins and leaves the conference. -->--}}


            {{--<!-- This button mutes and unmutes the users' microphone. -->--}}

        {{--</div>--}}
        {{--<div id="toolbarRight" class="toolbar">--}}

        {{--</div>--}}

        <!-- This is the div into which the Vidyo component will be inserted. -->

        {{--<div id="helper">--}}
            {{--<table>--}}
                {{--<tr>--}}
                    {{--<td><img class="logo" src="img/VidyoIO-LogoHorizontal-Dark@2x.png"/></td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td id="helperText">How would you like to join the call?</td>--}}
                {{--</tr>--}}
                {{--<tr id="helperPicker">--}}
                    {{--<td >--}}
                        {{--<table>--}}
                            {{--<tr>--}}
                                {{--<td id="joinViaBrowser" class="hidden">--}}
                                    {{--<div class="helperHeader">--}}
                                        {{--<img src="img/web.svg" onclick="javascript:joinViaBrowser()"/>--}}
                                    {{--</div>--}}
                                    {{--<ul>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Join the call immediately--}}
                                        {{--</li>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--No downloads or installations--}}
                                        {{--</li>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Good quality--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--<div class="helperFooter">--}}
                                        {{--<a href="javascript:joinViaBrowser()">Join via the browser</a>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td id="joinViaPlugIn" class="hidden">--}}
                                    {{--<div class="helperHeader">--}}
                                        {{--<img src="img/download.svg" onclick="javascript:joinViaPlugIn()"/>--}}
                                    {{--</div>--}}
                                    {{--<ul>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Join meetings right from the browser--}}
                                        {{--</li>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Share seamlessly without extensions--}}
                                        {{--</li>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Best quality--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--<div class="helperFooter">--}}
                                        {{--<a href="javascript:joinViaPlugIn()">Join via the plugin</a>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td id="joinViaApp" class="hidden">--}}
                                    {{--<div class="helperHeader">--}}
                                        {{--<img src="img/desktop.svg" onclick="javascript:joinViaApp()"/>--}}
                                    {{--</div>--}}
                                    {{--<ul>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Join meetings faster with fewer clicks--}}
                                        {{--</li>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Share seamlessly without extensions--}}
                                        {{--</li>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Best quality--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--<div class="helperFooter">--}}
                                        {{--<a href="javascript:joinViaApp()">Join via the app</a>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td id="joinViaOtherApp" class="hidden">--}}
                                    {{--<div class="helperHeader">--}}
                                        {{--<img src="img/download.svg" onclick="javascript:joinViaOtherApp()"/>--}}
                                    {{--</div>--}}
                                    {{--<ul>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Join from any device--}}
                                        {{--</li>--}}
                                        {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                            {{--Best quality--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--<div class="helperFooter">--}}
                                        {{--<a href="javascript:joinViaOtherApp()">Join via the app</a>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--</table>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr id="helperPlugIn" class="hidden">--}}
                    {{--<td>--}}
                        {{--<div class="helperHeader">--}}
                            {{--<img src="img/download.svg" onclick="javascript:joinViaBrowser()"/>--}}
                        {{--</div>--}}
                        {{--<ul>--}}
                            {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                {{--Download and install it now--}}
                            {{--</li>--}}
                            {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                {{--The plugin will launch automatically once installed--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<div class="helperFooter">--}}
                            {{--<a id="helperPlugInDownload" href="">Download</a>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr id="helperApp" class="hidden">--}}
                    {{--<td>--}}
                        {{--<div class="helperHeader">--}}
                            {{--<img src="img/download.svg" onclick="javascript:joinViaApp()"/>--}}
                        {{--</div>--}}
                        {{--<div><iframe id="helperAppLoader" src="" class="hidden"></iframe></div>--}}
                        {{--<ul>--}}
                            {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                {{--Download and install it now--}}
                            {{--</li>--}}
                            {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                {{--Launch once installed--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<div class="helperFooter">--}}
                            {{--<a id="helperAppDownload" href="">Download</a>--}}
                            {{--<a href="javascript:joinViaApp()">Launch</a>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr id="helperOtherApp" class="hidden">--}}
                    {{--<td>--}}
                        {{--<div class="helperHeader">--}}
                            {{--<img src="img/download.svg" onclick="javascript:joinViaOtherApp()"/>--}}
                        {{--</div>--}}
                        {{--<div><iframe id="helperOtherAppLoader" src="" class="hidden"></iframe></div>--}}
                        {{--<ul>--}}
                            {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                {{--Build and install from the SDK--}}
                            {{--</li>--}}
                            {{--<li class="helperCheck"><img src="img/checkmark.svg"/>&nbsp;&nbsp;--}}
                                {{--Launch once installed--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<div class="helperFooter">--}}
                            {{--<a href="javascript:joinViaOtherApp()">Launch</a>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td>--}}
                        {{--<div id="downloadContainerLegal">--}}
                            {{--By clicking &quot;Join&quot; or &quot;Download&quot;, you agree to our <a target="_blank" style="color: #6a6a6a;" href="http://www.vidyo.com/eula/">End-User License Agreement</a> & <a target="_blank" style="color: #6a6a6a;" href="http://www.vidyo.com/privacy-policy/">Privacy Policy</a>.--}}
                        {{--</div>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</div>--}}
        {{--<div id="failed" class="hidden">--}}
            {{--<table>--}}
                {{--<tr>--}}
                    {{--<td><img class="logo" src="img/VidyoIcon.png"/></td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td id="failedText">Error</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</div>--}}

    {{--</div>--}}

        {{--<div id="vidyoConnector">--}}

            <!-- This button toggles the visibility of the options. -->
            {{--<button id="optionsVisibilityButton" title="Toggle Options" class="optionsVisibiliyButtonElements hideOptions hidden"></button>--}}

            {{--<div id="options" class="hidden">--}}
                {{--<img class="logo" src="img/VidyoIcon.png"/>--}}

                {{--<form>--}}
                    {{--<div id="optionsParameters">--}}
                        {{--<p>--}}
                            {{--<!-- The host of our backend service. -->--}}
                            {{--<label>Host</label>--}}
                            {{--<input type="text" id="host" value="prod.vidyo.io">--}}
                        {{--</p>--}}
                        {{--<p>--}}
                            {{--<!-- A token that is derived from the deveoper key assigned to your account which will allow access for this particular instance.--}}
                            {{--The token will contain its expiration date and the user ID.--}}
                            {{--For more information visit the developer section of http://vidyo.io -->--}}
                            {{--<label>Token</label>--}}
                            {{--<input type="text" id="token" placeholder="ACCESS-TOKEN" value="">--}}
                        {{--</p>--}}
                        {{--<p>--}}
                            {{--<!-- This is the display name that other users will see.--}}
                            {{---->--}}
                            {{--<label for="displayName">Display Name</label>--}}

                        {{--</p>--}}
                        {{--<p>--}}
                            {{--<!-- This is the "room" or "space" to which you're connecting--}}
                            {{--the user. Other users who join this same Resource will be able to see and hear each other.--}}
                            {{---->--}}
                            {{--<label for="resourceId">Resource ID</label>--}}
                            {{--<input id="resourceId" type="text" placeholder="Conference Reference" value="demoRoom">--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    {{--<p>--}}
                        {{--<!-- On page load, this input is filled with a list of all the available cameras on the user's system. -->--}}
                        {{--<label for="cameras">Camera</label>--}}
                        {{--<select id="cameras">--}}
                            {{--<option value='0'>None</option>--}}
                        {{--</select>--}}
                    {{--</p>--}}
                    {{--<p>--}}
                        {{--<!-- On page load, this input is filled with a list of all the available microphones on the user's system. -->--}}
                        {{--<label for="microphones">Microphone</label>--}}
                        {{--<select id="microphones">--}}
                            {{--<option value='0'>None</option>--}}
                        {{--</select>--}}
                    {{--</p>--}}
                    {{--<p>--}}
                        {{--<!-- On page load, this input is filled with a list of all the available microphones on the user's system. -->--}}
                        {{--<label for="speakers">Speaker</label>--}}
                        {{--<select id="speakers">--}}
                            {{--<option value='0'>None</option>--}}
                        {{--</select>--}}
                    {{--</p>--}}
                    {{--<p id="monitorShareParagraph">--}}
                        {{--<!-- On page load, this input is filled with a list of all the available monitor shares on the user's system. -->--}}
                        {{--<label for="monitorShares">Monitor Share</label>--}}
                        {{--<select id="monitorShares">--}}
                            {{--<option value='0'>None</option>--}}
                        {{--</select>--}}
                    {{--</p>--}}
                    {{--<p>--}}
                        {{--<!-- On page load, this input is filled with a list of all the available window shares on the user's system. -->--}}
                        {{--<label for="windowShares">Window Share</label>--}}
                        {{--<select id="windowShares">--}}
                            {{--<option value='0'>None</option>--}}
                        {{--</select>--}}
                    {{--</p>--}}
                {{--</form>--}}
                {{--<div id="messages">--}}
                    {{--<!-- All Vidyo-related messages will be inserted into these spans. -->--}}
                    {{--<span id="error"></span>--}}
                    {{--<span id="message"></span>--}}
                {{--</div>--}}
            {{--</div>--}}


        {{--</div>--}}

    {{--</div>--}}


@endsection


@push('medsitter_vidyo_connector')


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
                    StartVidyoConnector(VC, VCUtils.params.webrtc);
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
                webrtcLogLevel = '&webrtcLogLevel=info';
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

@endpush