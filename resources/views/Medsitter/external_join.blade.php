@extends('layouts.medsitter.external')

@section('content')


    <section class="row mt-3">

        <div class="col-lg-8" style="margin-left: 2.5%;">

            <div class="card text-white" style="background-color: transparent;border: none">
                <div class="card-block">
                    <h1 class="card-title" style="border: none;">Join a pod</h1>

                    <div class="card-text ml-5">
                    Select an actively looking pod to fill in patient information and join the pod.
                    </div>

                </div>
            </div>

        </div>

    </section>

    <div id="pods" class="mt-4">
        @foreach($pods as $pod)

            @if($pod->active === 1)
                <div class="row mt-2" id="pod-row-{{$pod->id}}">
                    <div class="col-lg-11" style="margin-left: 3.75%;">
                        <div class="card" style="background-color: #434857 !important">
                            <div class="card-block text-white" style="padding: 8px;">
                                <div class="row" id="pod-inner-row-{{$pod->id}}">

                                    <div class="col-lg-2 align-self-center">
                                        <a id="pod-patient-link-{{$pod->id}}" data-toggle="modal" data-target="#patientModal" class="btn btn-outline-teal"  role="button" onclick="changeSubmit('{{$pod->id}}')">Join</a>
                                    </div>

                                    <div class="col-lg-2 align-self-center">
                                        <div class="ml-5 ">
                                            <span id="pod-name-{{$pod->id}}">{{$pod->name}}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 align-self-center">
                                        <div class="progress">
                                            <div id="pod-participant-count-{{$pod->id}}" class="progress-bar" role="progressbar" style="width: {{100*($pod->patient_count/4)}}%" aria-valuenow="{{100*($pod->patient_count/4)}}%" aria-valuemin="0" aria-valuemax="100">{{$pod->patient_count}} / 4</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 align-self-center">
                                        <div class="text-center">
                                            <span id="pod-sitter-count-{{$pod->id}}">{{$pod->sitter_count}}</span><span> Sitter(s)</span>
                                            <span id="pod-patient-count-{{$pod->id}}">{{$pod->patient_count}}</span><span> Patient(s)</span>
                                        </div>
                                    </div>

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
                            <label for="firstname">First Name</label>
                            <input class="form-control" id="firstname" placeholder="Jane" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input class="form-control" id="lastname" placeholder="Doe" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="contactnumber">Contact Phone Number</label>
                            <input class="form-control" id="contactnumber" placeholder="317-555-5555" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input class="form-control" id="code" placeholder="1234" type="text" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a id="patient-cancel" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                    <a id="patient-submit" value="" class="btn btn-nav-orange" style="cursor: pointer !important; -webkit-appearance: none !important;" type="submit"><i class="fa fa-plus"></i> Admit</a>
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

@endsection


@push('medsitter_external_join')

    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>

    <script type="text/javascript">

        Echo.private('medsitter-join-url')
            .listen('EventJoinPatient', event => {
                if(room_key === event.key) {
                    window.location.href = event.url;
                }
            });

        function changeSubmit(podId) {
            $('#patient-submit').attr('value', podId);
        }

        let room_key;

        $('#patient-submit').click(function(){

            if($('#patient-form').valid()) {

                console.log('test');

                let firstname = $('#firstname').val();
                let lastname = $('#lastname').val();
                let phonenumber = $('#contactnumber').val();
                let microphonestatus = $('#patient-microphone-status').val();
                let code = $('#code').val();


                console.log(firstname);

                let podid = $(this).attr('value');

                $.ajax({
                    type: "POST",
                    url: '/medsitter/external/join',
                    data: {
                        firstname: firstname,
                        lastname: lastname,
                        phonenumber: phonenumber,
                        microphonestatus: microphonestatus,
                        type: "patient",
                        podid: podid,
                        code: code
                    },
                    success: function (data) {
                        // add note dynamically to note list //

                        room_key = data.key;

                        $('#patientModal').modal('toggle');

                        $('#waitingModal').modal('toggle');

                        console.log(room_key);

                    }
                });
            }
        });

    </script>

@endpush