<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}}" id="card-block-tab-{{$tab_count}}" role="tabpanel">

    <div id="contacts-title" class="row mt-2 mb-3">
        <div class="col-lg-6">
            <h5 class="card-title text-white">Contacts</h5>
        </div>
        <div class="col-lg-6">
            <a id="account-card-block-a" href="#" class="btn btn-nav-blue float-right"  data-toggle="modal" data-target="#contactModal">Add Contact</a>
        </div>
    </div>

    @if(count($persons) > 0)

        @foreach($persons as $p)


            <h5 class="card-title mt-2 text-white">{{$p->fullname}}</h5>
            <div class="card-text text-white">
                {{--<ul class="list-group row" style="background-color: transparent;">--}}
                    <div class="row">
                        <li class="col-lg-6 list-group-item" style="background-color: transparent; border: none;">
                        {{--<div class="col-lg-6">--}}
                            <div class="col-lg-4">Email</div>
                            <div class="col-lg-8">{{$p->email}}</div>
                            <div class="col-lg-4">Phone Number</div>
                            <div class="col-lg-8">{{$p->number}}</div>
                            <div class="col-lg-4">Phone Type</div>
                            <div class="col-lg-8">{{$p->phonetype}}</div>
                            <div class="col-lg-4">Address</div>
                            <div class="col-lg-8">{{$p->address}}</div>
                            <div class="col-lg-4">City</div>
                            <div class="col-lg-8">{{$p->city}}</div>
                            <div class="col-lg-4">State</div>
                            <div class="col-lg-8">{{$p->state}}</div>
                            <div class="col-lg-4">Postal Code</div>
                            <div class="col-lg-8">{{$p->zip}}</div>
                        </li>
                        {{--</div>--}}
                        <div class="col-lg-6">
                            @php

                                $count = count($p->badges);

                            @endphp

                            <div class="row mt-lg-5">
                            @foreach($p->badges as $badge)

                                @if($badge === "IDSuite")

                                    <div class="col-lg-{{12/$count}}">
                                        <h2><span class="badge badge-pill badge-warning">IDSuite</span></h2>
                                    </div>

                                @elseif($badge === "NetSuite")

                                    <div class="col-lg-{{12/$count}}">
                                        <h2><span class="badge badge-pill badge-info">NetSuite</span></h2>
                                    </div>

                                @elseif($badge === "Manual")

                                    <div class="col-lg-{{12/$count}}">
                                        <h2><span class="badge badge-pill badge-success">Manual</span></h2>
                                    </div>

                                @elseif($badge === "Trust")

                                    <div class="col-lg-{{12/$count}}">
                                        <h2><span class="badge badge-pill badge-danger">Trust</span></h2>
                                    </div>

                                @endif


                            @endforeach
                            </div>
                        </div>
                    </div>
                {{--</ul>--}}
            </div>

            @if(!$loop->last)
                <hr id="contact-last-hr" class="mb-4" style="border-color: #d59043">
            @endif

        @endforeach

    @else

        <p class="card-text text-white">We currently do not have any contacts associated with this account.</p>

    @endif


    <!-- Modal -->
        <div class="modal" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: white;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="contact-form">
                            <div class="form-group">
                                <label for="contact-first-name">First Name</label>
                                <input class="form-control" id="contact-first-name" placeholder="Janis" minlength="2" type="text" required/>
                            </div>
                            <div class="form-group">
                                <label for="contact-middle-name">Middle Name</label>
                                <input class="form-control" id="contact-middle-name" placeholder="Dorthy"/>
                            </div>
                            <div class="form-group">
                                <label for="contact-last-name">Last Name</label>
                                <input class="form-control" id="contact-last-name" placeholder="Doe" minlength="2" type="text" required/>
                            </div>
                            <div class="form-group">
                                <label for="contact-preferred-name">Preferred Name</label>
                                <input class="form-control" id="contact-preferred-name" placeholder="Jan"/>
                            </div>
                            <div class="form-group">
                                <label for="contact-title">Title</label>
                                <input class="form-control" id="contact-title" placeholder="Owner" minlength="2" type="text" required/>
                            </div>

                            <div class="form-group">
                                <label for="contact-email">Email</label>
                                <input class="form-control" id="contact-email" placeholder="JDoe@Gmail.com" type="email" required/>
                            </div>

                            <div class="form-group">
                                <label for="contact-phone-number">Phone Number</label>
                                <input class="form-control" id="contact-phone-number" name="contact-phone-number" placeholder="3175553212"/>
                            </div>

                            <div class="form-group">
                                <label for="contact-phone-type">Phone Type</label>
                                <select class="form-control" id="contact-phone-type"></select>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a id="contact-cancel" class="btn btn-nav-pink" data-dismiss="modal" style="cursor: pointer !important;">Close</a>
                        <a id="contact-submit" class="btn btn-nav-orange" style="cursor: pointer !important;"><i class="fa fa-plus"></i> Add Contact</a>
                    </div>
                </div>
            </div>
        </div>

</div>




@push('account_contacts')

    <script>

        $('#contact-form').validate({
            rules: {
                "contact-phone-number": {
                    required: true,
                    phoneUS: true
                }
            }
        });

        $('#contact-submit').click(function(){

            if($('#contact-form').valid()) {

                let firstname = $('#contact-first-name').val();
                let middlename = $('#contact-middle-name').val();
                let lastname = $('#contact-last-name').val();
                let preferredname = $('#contact-preferred-name').val();
                let title = $('#contact-title').val();
                let email = $('#contact-email').val();
                let phonenumber = $('#contact-phone-number').val();
                let phonetype = $('#contact-phone-type').val();

                $.ajax({
                    type: "POST",
                    url: '/api/personcontacts',
                    data: {
                        firstname: firstname,
                        middlename: middlename,
                        lastname: lastname,
                        preferredname: preferredname,
                        title: title,
                        email: email,
                        phonenumber: phonenumber,
                        phonetype: phonetype
                    },
                    success: function (data) {
                        // add note dynamically to note list //

                        $('#contactModal').modal('hide');

                        console.log($('#contact-default').length);

                        if ($('#note-default').length === 1) {
                            $('#note-default').hide();
                            $('#note-last-hr').hide();
                            $('#notes-title').after('<div class="card-text text-white"><div>' + data.text + '</div><small>created - ' + data.created_at + '</small></div><hr class="mb-4" style="border-color: #9F86FF">')
                        } else {
                            $('#notes-title').after('<div class="card-text text-white"><div>' + data.text + '</div><small>created - ' + data.created_at + '</small></div><hr class="mb-4" style="border-color: #9F86FF">')
                        }
                    }
                });
            } else {

            }

        });
    </script>


    <script>
        $.ajax({
            type: "GET",
            url: '/phoneTypeEnum',
            success: function (data) {
                $.each(data.data, function(index, value){

                    $('#contact-phone-type').append('<option value="'+ index +'">'+value+'</option>')
                })

            }
        });
    </script>



@endpush