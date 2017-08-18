
@extends('layouts.app')

@section('content')

    <div class="text-white mt-4">
        <div class="row">
            <div class="col-4 offset-1">
                <h2>SMS Message</h2>
            </div>
        </div>

        <div class="col-lg-10 offset-1">
            <hr style="border-top: 2px solid rgba(255, 255, 255, 1) !important;">
        </div>

        <div class="row">
            <div class="col-1"></div>
            <div class="ml-lg-5 col-4">
                <div class="ml-4 form-group row">
                    <label for="text-number" class="col-2 col-form-label">Telephone</label>
                    <div class="col-4">
                        <input class="form-control" type="tel" placeholder="3175551234" id="text-number">
                    </div>
                </div>
                <div class="ml-4 form-group row">
                    <label for="text-message" class="col-2 col-form-label">Message</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" placeholder="Type your message..." id="text-message"></textarea>
                    </div>
                </div>
                <button id='text-button' type="button" class="btn btn-primary float-right">Send</button>
            </div>
            <div id="message-status" class="col-6">

            </div>
        </div>

        <div class="row">
            <div class="col-4 offset-1">
                <h2>Peer Video and Messaging</h2>
            </div>
        </div>

        <div class="col-lg-10 offset-1">
            <hr style="border-top: 2px solid rgba(255, 255, 255, 1) !important;">
        </div>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-5" id="connect">
                <div class="ml-lg-5 form-group row">
                    <label for="name" class="col-1 col-form-label">ID</label>
                    <div class="col-5">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                    </div>
                    <div class="col-5">
                        <input class="form-control" type="text" name="peer_id" id="peer_id" placeholder="Peer ID">
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="row">
                    <div id="connected_peer_container" class="hidden">
                        Connected Peer:
                        <span id="connected_peer"></span>
                    </div>
                </div>

                <div class="row">

                    <div id="connected_peer_container" class="hidden">
                        My ID:
                        <span id="id"></span>
                    </div>

                </div>
            </div>


            <div class="col-3">
                <div id="peer-camera" class="camera">
                    <video width="300" height="300" autoplay></video>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-1"></div>
            <div id="chat" class="hidden col-5">
                <div class="ml-lg-5 form-group row">
                    <label for="message" class="col-1 col-form-label">Text</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" placeholder="Type your message..." id="message"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 ml-lg-5">
            <div class="col-1"></div>
            <div class="col-5">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-2">
                        <button id="login" type="button" class="btn btn-primary">Login</button>
                    </div>
                    <div class="col-8">
                        <button id="send-message" type="button" class="btn btn-primary float-right mr-4">Send Message</button>
                        <button id="call" type="button" class="btn btn-primary float-right mr-3">Call</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('webrtc')

<script id="messages-template" type="text/x-handlebars-template">
    @{{#each messages}}
    <li>
        <span class="from">@{{from}}:</span> @{{text}}
    </li>
    @{{/each}}
</script>

<script>

    $('#text-button').click(function(){



        $.ajax({
            url: "/twilio",
            method: "POST",
            data: {
                number: $('#text-number').val(),
                text: $('#text-message').val()
            },
            success: function(data){

                console.log(data)

                if(data.status === "success"){

                    $('#message-status')
                        .empty()
                        .append('<span style="color: green">Message successfully sent.</span>');

                }
                else{

                    $('#message-status')
                        .empty()
                        .append('<span style="color: red">'+data.data+'</span>');

                }


            },
            error: function(data){

                alert('There was an error. this is the message: ' + data);

            }
        })

    });


</script>



<script>

    $.ajax({
        type: "GET",
        url: '/getAuthUser',
        success: function(data){
            console.log(data);
        },
        error: function(message){

        }
    });


    $(function(){

        let messages = [];
        let peer_id, name, conn;
        let messages_template = Handlebars.compile($('#messages-template').html());
        let peer = new Peer('{{$user_id}}',
            {
                key: 'peerjs',
                host: 'idsuite.xyz',
                port: 9000,
                path: '/'
            });




        peer.on('open', function(){

            console.log(peer.id);

            $('#id').text(peer.id);
        });

        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

        function getVideo(callback){
            navigator.getUserMedia({audio: true, video: true}, callback, function(error){
                console.log(error);
                alert('An error occured. Please try again');
            });
        }

        getVideo(function(stream){
            window.localStream = stream;
            onReceiveStream(stream, 'my-camera');
        });

        function onReceiveStream(stream, element_id){
            console.log('element id : ' + element_id);
            let video = $('#' + element_id + ' video')[0];
            video.src = window.URL.createObjectURL(stream);
            window.peer_stream = stream;
        }

        $('#login').click(function(){
            name = $('#name').val();
            peer_id = $('#peer_id').val();
            if(peer_id){
                conn = peer.connect(peer_id, {metadata: {
                    'username': name
                }});
                conn.on('data', handleMessage);
            }

            $('#chat').removeClass('hidden');
            $('#connect').addClass('hidden');
        });

        peer.on('connection', function(connection){
            conn = connection;
            peer_id = connection.peer;
            conn.on('data', handleMessage);

            $('#peer_id').addClass('hidden').val(peer_id);
            $('#connected_peer_container').removeClass('hidden');
            $('#connected_peer').text(connection.metadata.username);
        });

        function handleMessage(data){
            let header_plus_footer_height = 285;
            let base_height = $(document).height() - header_plus_footer_height;
            let messages_container_height = $('#messages-container').height();
            messages.push(data);

            let html = messages_template({'messages' : messages});
            $('#messages').html(html);

            if(messages_container_height >= base_height){
                $('html, body').animate({ scrollTop: $(document).height() }, 500);
            }
        }

        function sendMessage(){
            let text = $('#message').val();
            let data = {'from': name, 'text': text};

            conn.send(data);
            handleMessage(data);
            $('#message').val('');
        }

        $('#message').keypress(function(e){
            if(e.which == 13){
                sendMessage();
            }
        });

        $('#send-message').click(sendMessage);

        $('#call').click(function(){
            console.log('now calling: ' + peer_id);
            console.log(peer);
            let call = peer.call(peer_id, window.localStream);
            call.on('stream', function(stream){
                window.peer_stream = stream;
                onReceiveStream(stream, 'peer-camera');
            });
        });

        peer.on('call', function(call){
            onReceiveCall(call);
        });

        function onReceiveCall(call){
            call.answer(window.localStream);
            call.on('stream', function(stream){
                window.peer_stream = stream;
                onReceiveStream(stream, 'peer-camera');
            });
        }

    });

</script>

@endpush