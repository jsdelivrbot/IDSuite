<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.js"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>


<script>
    let axiosrequests = [];


    /**
     *
     * setContactTab
     *
     * set custom tab Contact by results
     *
     *
     */
    function setContactTab(objects, el) {

        $.each(objects, function (key, value) {

            let badges ='';

            let badges_count = value.badges.length;

            $.each(value.badges, function(key, value){

                if(value === 'NetSuite'){
                    badges =
                        '<div class="mt-3 col-lg-'+12/badges_count+'">' +
                        '<h2>' +
                        '<span class="badge badge-pill badge-warning">NetSuite</span>' +
                        '</h2>' +
                        '</div>'
                }
                if(value === 'Trust'){
                    badges = badges +
                        '<div class="mt-3 col-lg-'+12/badges_count+'">' +
                        '<h2>' +
                        '<span class="badge badge-pill badge-info">Trust</span>' +
                        '</h2>' +
                        '</div>'
                }
                if(value === 'IDSuite'){
                    badges = badges +
                        '<div class="mt-3 col-lg-'+12/badges_count+'">' +
                        '<h2>' +
                        '<span class="badge badge-pill badge-danger">IDSuite</span>' +
                        '</h2>' +
                        '</div>'
                }
            });


            if (objects.length === key + 1) {
                el.append(
                    '<h3 class="card-title mt-3 text-white">' + value.fullname + '</h3>' +
                    '<div class="card-block text-white">' +
                    '<div class="row">' +
                    '<div class="col-lg-4">Email</div>' +
                    '<div class="col-lg-8">' + value.email + '</div>' +
                    '<div class="col-lg-4">Phone Number</div>' +
                    '<div class="col-lg-8">' + value.number + '</div>' +
                    '<div class="col-lg-4">Address</div>' +
                    '<div class="col-lg-8">' + value.address + '</div>' +
                    '<div class="col-lg-4">City</div>' +
                    '<div class="col-lg-8">' + value.city + '</div>' +
                    '<div class="col-lg-4">State</div>' +
                    '<div class="col-lg-8">' + value.state + '</div>' +
                    '<div class="col-lg-4">Postal Code</div>' +
                    '<div class="col-lg-8">' + value.zip + '</div>' +
                    ' '+ badges + '' +
                    '</div>' +
                    '</div>'
                );
            } else {
                el.append(
                    '<h3 class="card-title mt-3 text-white">' + value.fullname + '</h3>' +
                    '<div class="card-block text-white">' +
                    '<div class="row">' +
                    '<div class="col-lg-4">Email</div>' +
                    '<div class="col-lg-8">' + value.email + '</div>' +
                    '<div class="col-lg-4">Phone Number</div>' +
                    '<div class="col-lg-8">' + value.number + '</div>' +
                    '<div class="col-lg-4">Address</div>' +
                    '<div class="col-lg-8">' + value.address + '</div>' +
                    '<div class="col-lg-4">City</div>' +
                    '<div class="col-lg-8">' + value.city + '</div>' +
                    '<div class="col-lg-4">State</div>' +
                    '<div class="col-lg-8">' + value.state + '</div>' +
                    '<div class="col-lg-4">Postal Code</div>' +
                    '<div class="col-lg-8">' + value.zip + '</div>' +
                    ' '+ badges +' ' +
                    '</div>' +
                    '</div>' +
                    '<hr class="mb-4" style="border-color: #d59043">'
                );
            }
        })
    }

    
    /**
     *
     * setLocationTab
     *
     * set custom tab location by results
     *
     *
    */
    function setLocationTab(objects, el) {

        $.each(objects, function (key, value) {


            if (objects.length === key + 1) {
                el.append(
                    '<h3 class="card-title mt-3 text-white">' + value.name + '</h3>' +
                    '<div class="card-block text-white">' +
                    '<ul class="list-group row" style="background-color: transparent;">' +
                    '<li class="col-lg-6 list-group-item" style="background-color: transparent; border: none;">' +
                    '<div class="col-lg-4">Email</div>' +
                    '<div class="col-lg-8">' + value.email + '</div>' +
                    '<div class="col-lg-4">Phone Number</div>' +
                    '<div class="col-lg-8">' + value.number + '</div>' +
                    '<div class="col-lg-4">Address</div>' +
                    '<div class="col-lg-8">' + value.address + '</div>' +
                    '<div class="col-lg-4">City</div>' +
                    '<div class="col-lg-8">' + value.city + '</div>' +
                    '<div class="col-lg-4">State</div>' +
                    '<div class="col-lg-8">' + value.state + '</div>' +
                    '<div class="col-lg-4">Postal Code</div>' +
                    '<div class="col-lg-8">' + value.zip + '</div>' +
                    '</li>' +
                    '</ul>' +
                    '</div>'
                );
            } else {
                el.append(
                    '<h3 class="card-title mt-3 text-white">' + value.name + '</h3>' +
                    '<div class="card-block text-white">' +
                    '<ul class="list-group row" style="background-color: transparent;">' +
                    '<li class="col-lg-6 list-group-item" style="background-color: transparent; border: none;">' +
                    '<div class="col-lg-4">Email</div>' +
                    '<div class="col-lg-8">' + value.email + '</div>' +
                    '<div class="col-lg-4">Phone Number</div>' +
                    '<div class="col-lg-8">' + value.number + '</div>' +
                    '<div class="col-lg-4">Address</div>' +
                    '<div class="col-lg-8">' + value.address + '</div>' +
                    '<div class="col-lg-4">City</div>' +
                    '<div class="col-lg-8">' + value.city + '</div>' +
                    '<div class="col-lg-4">State</div>' +
                    '<div class="col-lg-8">' + value.state + '</div>' +
                    '<div class="col-lg-4">Postal Code</div>' +
                    '<div class="col-lg-8">' + value.zip + '</div>' +
                    '</li>' +
                    '</ul>' +
                    '</div>' +
                    '<hr class="mb-4" style="border-color: #1BC98E">'
                );
            }
        })
    }

    /**
     *
     * createEndpointCards
     *
     * creates the cards that represent customers in the this view at cards id.
     *
     * @param objects
     */
    function createCards(objects, url) {

        let rowkey;

        $.each(objects, function (key, value) {
            if (key % 3 === 0 || key === objects.length) {
                rowkey = key;
                $('#cards').append('<div class="row" id="row-' + key + '">');

                $('#row-' + key).prepend(
                    '<div class="col-lg-4"> ' +
                    '<div class="card mb-3 text-center" style="background-color: #1BC98E;color: #252830 !important; border: 6px solid rgba(255, 255, 255, 0.2);">' +
                    '<div class="card-block"> ' +
                    '<h4 class="card-title text-truncate">' + value.name + '</h4> ' +
                    '<div class="searchfilterterm" style="display: none;">' + value.name.toLowerCase() + '</div> ' +
                    '<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p> ' +
                    '<a href="' + url + '' + value.id + '" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a> ' +
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
                    '<a href="' + url + '' + value.id + '" class="btn btn-outline-secondary" style="color: white !important; border-color: white !important;">View Account</a> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div>'
                )
            }
        });
    }

    /**
     *
     * setQuantity
     *
     * set the quantity to the entities-count id.
     *
     * @param objects
     */
    function setQuantity(objects, el) {
        el.text('Qty: ' + objects.length);
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


    function setChartHW(el, width, height){
        el
            .width(width)
            .height(height);
    }

    /**
     *
     * validate
     *
     * validates axios requests and alerts if error is present
     *
     * @param data
     */
    function validate(data) {
        if (typeof data.error !== 'undefined') {
            alert("Request: " + data.request +
                "\n" +
                "Error: " + data.error
            );

            return false;
        } else {
            return true;
        }
    }


    /**
     *
     * axiosAll
     *
     * takes all request pushed into axiosrequest array and runs them concurrently.
     *
     * @param requests
     */
    function axiosAll(requests) {
        axios.all(requests)
            .then(axios.spread(function () {
                console.log("axios_all complete");
            }));
    }

    /**
     *
     * createSidebarLinks
     *
     * creates the sidebar from the links data passed in.
     *
     * @param links
     */
    function createSidebarLinks(links) {
        $.each(links, function (key, value) {
            $('#measure-links').append(
                '<li class="nav-item">' +
                    '<a class="nav-link ' + value.class + ' text-white" href="' + value.url + '">' + key + '</a>' +
                '</li>'
            )
        });
    }

    /**
     *
     * getSidebarLinks
     *
     * returns all the entities objects to create the cards.
     *
     * @param user_id
     */
    function getSidebarLinks(user_id) {

        let options = JSON.stringify({
            id: user_id
        });

        return axios.get('/api/enum/measure/links/' + options)
            .then(function (response) {
                let links = response.data;

                if(!validate(links)){
                    return false;
                }

                createSidebarLinks(links);
            });
    }


    $(document).ready(function(){
        @if(!Auth::guest())
            axiosrequests.push = getSidebarLinks('{{Auth::user()->id}}');
        @else

        @endif
    });

</script>


