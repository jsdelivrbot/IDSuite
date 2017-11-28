@extends('layouts.app')

@section('content')
    <div>
        <video id="monitor" autoplay></video>
    </div>
    <div>
        <input type="button" value="Start" onclick="start()" id="startBtn">
        <input type="button" value="Print Media Object" onclick="print()" id="printBtn">
        <select id="input-audio"></select>
        <select id="input-video"></select>
        <select id="output-audio"></select>
    </div>

<script>

    let inputaudio = document.getElementById('input-audio');

    let inputvideo = document.getElementById('input-video');

    let outputvideo = document.getElementById('output-audio');

    let selectors = [inputaudio, inputvideo, outputvideo];

    var startBtn = document.getElementById('startBtn');

    let videoElement = document.getElementById('monitor');

    let tracks = [];

    function gotStream(stream) {
        video = document.getElementById('monitor');

        video.srcObject = stream;

        tracks = stream.getTracks();

        stream.getTracks().forEach(function (track) {
            track.onended = function () {
                startBtn.disabled = stream.active;
            };
        });
    }



    function print(){

        navigator.getUserMedia = navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia;
        console.log(navigator.getUserMedia);
        navigator.mediaDevices.enumerateDevices().then(function(sources){

            console.log(sources);

            for(i = 0; i < sources.length; i++ ){

                let source = sources[i];
                let label = source.label;

                switch(source.kind){

                    case "audioinput":

                        $('#input-audio').append('<option value="'+source.deviceId+'">' + label + '</option>');

                        break;

                    case "videoinput":

                        $('#input-video').append('<option value="'+source.deviceId+'">' + label + '</option>');

                        break;

                    case "audiooutput":

                        $('#output-audio').append('<option value="'+source.deviceId+'">' + label + '</option>');

                        break;


                    default:
                        break;

                }

            }


            let values = selectors.map(function(select) {
                return select.value;
            });

            selectors.forEach(function(select, selectorIndex) {
                if (Array.prototype.slice.call(select.childNodes).some(function(n) {

                    n.value === values[selectorIndex];

                    console.log(n.value);

                    return n.value;

                })) {
                    select.value = values[selectorIndex];

                    console.log(select.value);

                }
            });


        });

    }

    function logError(error) {
        console.log(error.name + ": " + error.message);
    }

    // Attach audio output device to video element using device/sink ID.
    function attachSinkId(element, sinkId) {
        if (typeof element.sinkId !== 'undefined') {
            element.setSinkId(sinkId)
                .then(function() {
                    console.log('Success, audio output device attached: ' + sinkId);
                })
                .catch(function(error) {
                    var errorMessage = error;
                    if (error.name === 'SecurityError') {
                        errorMessage = 'You need to use HTTPS for selecting audio output ' +
                            'device: ' + error;
                    }
                    console.error(errorMessage);
                    // Jump back to first output device in the list as it's the default.
                    audioOutputSelect.selectedIndex = 0;
                });
        } else {
            console.warn('Browser does not support output device selection.');
        }
    }

    function changeAudioDestination() {
        var audioDestination = audioOutputSelect.value;
        attachSinkId(videoElement, audioDestination);
    }

    function gotStream(stream) {
        window.stream = stream; // make stream available to console
        videoElement.srcObject = stream;
        // Refresh button list in case labels have become available
        return navigator.mediaDevices.enumerateDevices();
    }

    function start() {
        if (window.stream) {
            window.stream.getTracks().forEach(function(track) {
                track.stop();
            });
        }
        var audioSource = inputaudio.value;
        var videoSource = inputvideo.value;
        var constraints = {
            audio: {deviceId: audioSource ? {exact: audioSource} : undefined},
            video: {deviceId: videoSource ? {exact: videoSource} : undefined}
        };

        navigator.mediaDevices.getUserMedia(constraints).
        then(gotStream).then(gotDevices).catch(handleError);
    }



</script>

@endsection