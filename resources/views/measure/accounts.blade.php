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
         * setQuantity
         *
         * set the quantity to the entities-count id.
         *
         * @param entities
         */
        function setQuantity(entities) {
            $('#entities-count').text('Qty: ' + entities.length);
        }

        /**
         *
         * createEntityCards
         *
         * creates the cards that represent customers in the this view at cards id.
         *
         * @param entities
         */
        function createEntityCards(entities) {

            let rowkey;

            $.each(entities, function (key, value) {
                if (key % 3 === 0 || key === entities.length) {
                    rowkey = key;
                    $('#cards').append('<div class="row" id="row-' + key + '">');

                    $('#row-' + key).prepend(
                        '<div class="col-lg-4"> ' +
                        '<div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">' +
                        '<div class="card-block"> ' +
                        '<h4 class="card-title text-truncate">' + value.name + '</h4> ' +
                        '<div class="searchfilterterm" style="display: none;">' + value.name.toLowerCase() + '</div> ' +
                        '<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p> ' +
                        '<a href="/measure/accounts/' + value.id + '" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div>'
                    )

                } else {
                    $('#row-' + rowkey).prepend('' +
                        '<div class="col-lg-4"> ' +
                        '<div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);"> ' +
                        '<div class="card-block"> ' +
                        '<h4 class="card-title text-truncate">' + value.name + '</h4> ' +
                        '<div class="searchfilterterm" style="display: none;">' + value.name.toLowerCase() + '</div> ' +
                        '<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p> ' +
                        '<a href="/measure/accounts/' + value.id + '" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div>'
                    )
                }
            });
        }

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
                        setQuantity(entities);
                        createEntityCards(entities);
                    } else {
                        alert('Hello {{Auth::user()->contact->name->first_name}} you don\'t seem to have any accounts to manage.');
                    }
                });
        }

        /**
         *
         * initSearchBox
         *
         * given the searchbox element and set containing the elements to search within. On a keypress this function will filter them.
         *
         * @param el
         * @param haystack
         */
        function initSearchBox(el, haystack) {
            el.keypress(function () {
                $('.card').parent().show();
                let filter = $(this).val();
                haystack.find(".searchfilterterm:not(:contains(" + filter.toLowerCase() + "))").parent().parent().parent().css('display', 'none');
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