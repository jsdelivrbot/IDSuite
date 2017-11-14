@extends('layouts.app')

@section('content')

    <section class="row mb-lg-2 mt-lg-4">

        <div class="col-lg-2">

            <h6 class="ml-lg-3 subtle-text text-subtle">SALES</h6>

            <h3 class="ml-lg-3 raleway text-white">Accounts</h3>

        </div>

        <div class="col-lg-10 text-white">

            <div class="row">

                <div class="col-lg-10">

                    <div class="float-right">

                        <input type="search" placeholder="Search Filter..." name="search"
                               class="form-control searchbox-input" required="">

                    </div>

                </div>

                <div class="col-lg-2">

                    <div class="float-right raleway" id="entities-count">

                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="col-lg-6 offset-3">

        <hr class="custom-hr">

    </div>

    <section id="cards">

    </section>

@endsection


@push('accounts')

    <script>

        /**
         *
         * getEntities
         *
         * returns all the entities objects to create the cards.
         *
         * @param user_id
         */
        function getEntities(user_id) {

            let options = JSON.stringify({
                id: user_id
            });

            return axios.get('/api/entities/' + options)
                .then(function (response) {
                    let entities = response.data;

                    if(!validate(entities)){
                        return false;
                    }

                    if (entities.length > 0) {
                        setQuantity(entities, $('#entities-count'));
                        createCards(entities, '/measure/accounts/');
                    } else {
                        alert('Hello {{Auth::user()->contact->name->first_name}} you don\'t seem to have any accounts to manage.');
                    }
                });
        }


        /**
         *
         * Document ready function. This gets ran first.
         *
         */
        $(document).ready(function () {
            axiosrequests.push = getEntities('{{Auth::user()->id}}');
            initSearchBox($('.searchbox-input'), $('#cards'));
        });
    </script>

@endpush