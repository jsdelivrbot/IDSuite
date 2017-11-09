<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.js"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>


<script>
    let axiosrequests = [];


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


