@extends('layouts.app')

@section('content')
    <div>
        <video id="monitor" autoplay></video>

        <canvas id="snapshot"></canvas>

    </div>
    <br>
    <div>
        <input type="button" value="Start" onclick="start()" id="startBtn">
        <input type="button" value="SnapShot" onclick="snapShot()" id="snapshot">
        <input type="button" value="Analyze face" onclick="processImage()">
        <input type="button" value="Print Media Object" onclick="print()" id="printBtn">
        <select id="input-audio"></select>
        <select id="input-video"></select>
        <select id="output-audio"></select>
    </div>
    <br>

    <div>

        <textarea id="responseTextArea" class="UIInput" style="width:580px; height:1000px;"></textarea>

    </div>


    <div>
        <canvas id="meter" width="1730" height="50"></canvas>
    </div>






<script>

    let meterwidth = 1730;

    let meterheight = 50;

    let rafID = null;

    let inputaudio = document.getElementById('input-audio');

    let inputvideo = document.getElementById('input-video');

    let outputvideo = document.getElementById('output-audio');

    let selectors = [inputaudio, inputvideo, outputvideo];

    var startBtn = document.getElementById('startBtn');

    let dataUrl;

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

        mediaStreamSource = audioContext.createMediaStreamSource(stream);

        meter = createAudioMeter(audioContext);
        mediaStreamSource.connect(meter);

        drawLoop();

        // Refresh button list in case labels have become available
        return navigator.mediaDevices.enumerateDevices();
    }

    function drawLoop( time ) {
        // clear the background
        canvasContext.clearRect(0,0, meterwidth, meterheight);

        // check if we're currently clipping
        if (meter.checkClipping())
            canvasContext.fillStyle = "red";
        else
            canvasContext.fillStyle = "green";

        // draw a bar based on the current volume
        canvasContext.fillRect(0, 0, meter.volume*meterwidth*20, meterheight);

        // set up the next visual callback
        rafID = window.requestAnimationFrame( drawLoop );
    }

    function start() {

        canvasContext = document.getElementById( "meter" ).getContext("2d");

        window.AudioContext = window.AudioContext || window.webkitAudioContext;

        audioContext = new AudioContext();


        if (window.stream) {
            window.stream.getTracks().forEach(function(track) {
                track.stop();
            });
        }
        var audioSource = inputaudio.value;
        var videoSource = inputvideo.value;
        var constraints = {
            video: {deviceId: videoSource ? {exact: videoSource} : undefined},
            audio: {
                mandatory: {
                    googEchoCancellation: false,
                    googAutoGainControl: false,
                    googNoiseSuppression: false,
                    googHighpassFilter: false
                },
                optional: []
            },
        };

        navigator.mediaDevices.getUserMedia(constraints).
        then(gotStream).then(function(stuff){
            console.log(stuff);
        }).catch(function (errorStuff) {
            console.log(errorStuff);
        });
    }

    function snapShot(){

        canvas = document.getElementById('snapshot');

        canvas.width = videoElement.videoWidth;
        canvas.height = videoElement.videoHeight;
        canvas.getContext('2d').
            drawImage(videoElement, 0, 0, canvas.width, canvas.height);


        data = canvas.toDataURL();

        options = JSON.stringify({
            img: data
        });

        $.ajax({
            url: "/api/image",
            type: "POST",
            data: {
                image: data
            },
            dataType: "json",
            success: function(response){

                console.log(response.filename);

                dataUrl = response.filename;


            }

        })


    }

    function createAudioMeter(audioContext,clipLevel,averaging,clipLag) {
        var processor = audioContext.createScriptProcessor(512);
        processor.onaudioprocess = volumeAudioProcess;
        processor.clipping = false;
        processor.lastClip = 0;
        processor.volume = 0;
        processor.clipLevel = clipLevel || 0.98;
        processor.averaging = averaging || 0.95;
        processor.clipLag = clipLag || 750;

        // this will have no effect, since we don't copy the input to the output,
        // but works around a current Chrome bug.
        processor.connect(audioContext.destination);

        processor.checkClipping =
            function(){
                if (!this.clipping)
                    return false;
                if ((this.lastClip + this.clipLag) < window.performance.now())
                    this.clipping = false;
                return this.clipping;
            };

        processor.shutdown =
            function(){
                this.disconnect();
                this.onaudioprocess = null;
            };

        return processor;
    }

    function volumeAudioProcess( event ) {
        var buf = event.inputBuffer.getChannelData(0);
        var bufLength = buf.length;
        var sum = 0;
        var x;

        // Do a root-mean-square on the samples: sum up the squares...
        for (var i=0; i<bufLength; i++) {
            x = buf[i];
            if (Math.abs(x)>=this.clipLevel) {
                this.clipping = true;
                this.lastClip = window.performance.now();
            }
            sum += x * x;
        }

        // ... then take the square root of the sum.
        var rms =  Math.sqrt(sum / bufLength);

        // Now smooth this out with the averaging factor applied
        // to the previous sample - take the max here because we
        // want "fast attack, slow release."
        this.volume = Math.max(rms, this.volume*this.averaging);
    }

    function processImage() {
        // **********************************************
        // *** Update or verify the following values. ***
        // **********************************************

        // Replace the subscriptionKey string value with your valid subscription key.
        var subscriptionKey = "c0d9e7f0352b4fd0a2881027c970d583";

        // Replace or verify the region.
        //
        // You must use the same region in your REST API call as you used to obtain your subscription keys.
        // For example, if you obtained your subscription keys from the westus region, replace
        // "westcentralus" in the URI below with "westus".
        //
        // NOTE: Free trial subscription keys are generated in the westcentralus region, so if you are using
        // a free trial subscription key, you should not need to change this region.
        var uriBase = "https://westcentralus.api.cognitive.microsoft.com/face/v1.0/detect";

        // Request parameters.
        var params = {
            "returnFaceId": "true",
            "returnFaceLandmarks": "false",
            "returnFaceAttributes": "age,gender,headPose,smile,facialHair,glasses,emotion,hair,makeup,occlusion,accessories,blur,exposure,noise",
        };

        // Display the image.
//        var sourceImageUrl = document.getElementById("inputImage").value;
//        document.querySelector("#sourceImage").src = sourceImageUrl;

        // Perform the REST API call.
        $.ajax({
            url: uriBase + "?" + $.param(params),

            // Request headers.
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key", subscriptionKey);
            },

            type: "POST",

            // Request body.
            data: '{"url": ' + '"' + dataUrl + '"}',
        })

            .done(function(data) {
                // Show formatted JSON on webpage.
                $("#responseTextArea").val(JSON.stringify(data, null, 2));
            })

            .fail(function(jqXHR, textStatus, errorThrown) {
                // Display error message.
                var errorString = (errorThrown === "") ? "Error. " : errorThrown + " (" + jqXHR.status + "): ";
                errorString += (jqXHR.responseText === "") ? "" : (jQuery.parseJSON(jqXHR.responseText).message) ?
                    jQuery.parseJSON(jqXHR.responseText).message : jQuery.parseJSON(jqXHR.responseText).error.message;
                alert(errorString);
            });
    };
</script>

@endsection