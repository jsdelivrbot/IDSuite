
@extends('layouts.app')

@section('content')


    <div class="text-white">


        <div id="messenger-wrapper" class="mt-3">
            <div class="container">
                <h1>Peer Messenger</h1>

                <div id="connect">
                    <h4>ID: <span id="id"></span></h4>
                    <input type="text" name="name" id="name" placeholder="Name">
                    <input type="text" name="peer_id" id="peer_id" placeholder="Peer ID">
                    <div id="connected_peer_container" class="hidden">
                        Connected Peer:
                        <span id="connected_peer"></span>
                    </div>
                    <button id="login">Login</button>
                </div>

                <div id="chat" class="hidden">
                    <div id="messages-container">
                        <ul id="messages"></ul>
                    </div>
                    <div id="message-container">
                        <input type="text" name="message" id="message" placeholder="Type message..">
                        <button id="send-message">Send Message</button>
                        <button id="call">Call</button>
                    </div>
                </div>

                <!-- Display video of the current user -->
                <div id="my-camera" class="camera">
                    <video width="200" height="200" autoplay></video>
                </div>

                <div id="peer-camera-zero" class="camera">
                    <video width="300" height="300" autoplay></video>
                </div>

                <div id="peer-camera-one" class="camera">
                    <video width="300" height="300" autoplay></video>
                </div>

                <div id="peer-camera-two" class="camera">
                    <video width="300" height="300" autoplay></video>
                </div>

                <div id="peer-camera-three" class="camera">
                    <video width="300" height="300" autoplay></video>
                </div>
            </div>


        </div>




        <script id="messages-template" type="text/x-handlebars-template">
            @{{#each messages}}
            <li>
                <span class="from">@{{from}}:</span> @{{text}}
            </li>
            @{{/each}}
        </script>
    </div>

@endsection


@push('webrtc')

<script>
    $(function(){

        let messages = [];
        let peer_id, name, conn;
        let messages_template = Handlebars.compile($('#messages-template').html());

        let peer = new Peer({
            key: 'hwesip1r0iicnmi',
            debug: 3,
            config: {'iceServers': [
                { url: 'stun:stun1.l.google.com:19302' },
                { url: 'turn:numb.viagenie.ca',
                    credential: 'muazkh', username: 'webrtc@live.com' }
            ]}
        });

        peer.on('open', function(){
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
                onReceiveStream(stream, 'peer-camera-zero');
            });
        });

        peer.on('call', function(call){
            onReceiveCall(call);
        });

        function onReceiveCall(call){
            call.answer(window.localStream);
            call.on('stream', function(stream){
                window.peer_stream = stream;
                onReceiveStream(stream, 'peer-camera-one');
            });
        }

    });

</script>

@endpush