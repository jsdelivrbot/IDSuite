<div class="tab-pane card-block active-outline-card-block-color-{{$tab_count}} contacts-tab"
     id="card-block-tab-{{$tab_count}}" role="tabpanel">

    <div id="contacts-title" class="row mt-2 mb-3">
        <div class="col-lg-6">
            <h5 class="card-title text-white">Contacts</h5>
        </div>
        <div class="col-lg-6">
            <a id="account-card-block-a" href="#" class="btn btn-nav-blue float-right" data-toggle="modal"
               data-target="#contactModal">Add Contact</a>
        </div>
    </div>


    <!-- Modal -->


    <div class="modal" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel"
         aria-hidden="true">
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
                            <input class="form-control" id="contact-first-name" placeholder="Janis" minlength="2"
                                   type="text" required/>
                        </div>
                        <div class="form-group">
                            <label for="contact-middle-name">Middle Name</label>
                            <input class="form-control" id="contact-middle-name" placeholder="Dorthy"/>
                        </div>
                        <div class="form-group">
                            <label for="contact-last-name">Last Name</label>
                            <input class="form-control" id="contact-last-name" placeholder="Doe" minlength="2"
                                   type="text" required/>
                        </div>
                        <div class="form-group">
                            <label for="contact-preferred-name">Preferred Name</label>
                            <input class="form-control" id="contact-preferred-name" placeholder="Jan"/>
                        </div>
                        <div class="form-group">
                            <label for="contact-title">Title</label>
                            <input class="form-control" id="contact-title" placeholder="Owner" minlength="2" type="text"
                                   required/>
                        </div>

                        <div class="form-group">
                            <label for="contact-email">Email</label>
                            <input class="form-control" id="contact-email" placeholder="JDoe@Gmail.com" type="email"
                                   required/>
                        </div>

                        <div class="form-group">
                            <label for="contact-phone-number">Phone Number</label>
                            <input class="form-control" id="contact-phone-number" name="contact-phone-number"
                                   placeholder="3175553212"/>
                        </div>

                        <div class="form-group">
                            <label for="contact-phone-type">Phone Type</label>
                            <select class="form-control" id="contact-phone-type"></select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <a id="contact-cancel" class="btn btn-nav-pink" data-dismiss="modal"
                       style="cursor: pointer !important;">Close</a>
                    <a id="contact-submit" class="btn btn-nav-orange" style="cursor: pointer !important;"><i
                                class="fa fa-plus"></i> Add Contact</a>
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

        function createPersonContact(entity_id) {
            if ($('#contact-form').valid()) {

                let firstname = $('#contact-first-name').val();
                let middlename = $('#contact-middle-name').val();
                let lastname = $('#contact-last-name').val();
                let preferredname = $('#contact-preferred-name').val();
                let title = $('#contact-title').val();
                let email = $('#contact-email').val();
                let phonenumber = $('#contact-phone-number').val();
                let phonetype = $('#contact-phone-type').val();

                options = JSON.stringify({
                    id: entity_id,
                    firstname: firstname,
                    middlename: middlename,
                    lastname: lastname,
                    preferredname: preferredname,
                    title: title,
                    email: email,
                    phonenumber: phonenumber,
                    phonetype: phonetype
                });

                axios.post('/api/personcontact/' + options)
                    .then(function (data) {

                        $('#contactModal').modal('hide');

                    });

            }
        }

        $('#contact-submit').click(function () {

            createPersonContact('{{$entity->id}}');
        });
    </script>


    <script>

        function getPhoneTypeEnum(user_id, el) {
            let options = JSON.stringify({
                id: user_id
            });

            return axios.get('/api/enum/phoneTypeEnum/' + options)
                .then(function (data) {
                    if (!validate(data.data)) {
                        return false;
                    }
                    $.each(data.data, function (key, value) {
                        el.append('<option value="' + key + '">' + value + '</option>')
                    });
                });
        }


        $(document).ready(function () {

            axiosrequests.push = getPhoneTypeEnum('{{Auth::user()->id}}', $('#contact-phone-type'));

        });


    </script>



@endpush