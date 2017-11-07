@extends('layouts.app')

@section('content')

    <div class="container p-lg-1">
        <div class="row mt-5 justify-content-center" >

            <div class="card col-lg-8 text-white" style="background-color: #434857; border-color: rgba(255, 255, 255, 0.2); ">
                <h3 class="card-header" style="background-color: #434857;">Create Endpoint</h3>
                <div class="card-block">
                    <p class="card-text">This is where you can configure and create endpoints.</p>


                    <form id="contact-form">
                        <div class="form-group">
                            <label for="endpoint-name">First Name</label>
                            <input class="form-control" id="endpoint-name" placeholder="ids-1000" minlength="2" type="text" required/>
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


                    <a href="#" class="btn btn-primary">Create</a>
                    <a href="#" class="btn btn-primary">Cancel</a>
                </div>
            </div>

        </div>
    </div>

@endsection