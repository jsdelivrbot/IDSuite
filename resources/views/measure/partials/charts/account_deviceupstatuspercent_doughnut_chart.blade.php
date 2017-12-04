<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Device Status Percentage</h5>
    </div>
</div>
<div class="row" style="height: 200px">
    <div class="col-lg-12 my-auto text-center">
        <img id="deviceupstatuspercentall-loader" src="/img/bars.svg" height="70px"/>
        <div id="deviceupstatuspercentall" class="chart-custom text-white" style="display: none;"></div>
    </div>
</div>

@push('account_deviceupstatuspercent_chart')

    <script src="https://www.amcharts.com/lib/3/pie.js"></script>

    <script>

        function chartDeviceUpStatusPercentAll(data) {

            console.log(data);

            console.log('^^^^^^^^^devicestatuspercent^^^^^^^^^');

            $('#deviceupstatuspercentall-loader').css('display', 'none');
            $('#deviceupstatuspercentall').css('display', 'block');

            let is_valid = true;

            let total_count = 0;

            $.each(data, function (key, value){
                total_count = value.count + total_count;
            });

            if(total_count === 0){
                is_valid = false;
            }

            if(data !== false && data.length > 0 && is_valid) {

                AmCharts.makeChart("deviceupstatuspercentall", {
                    type: "pie",
                    theme: "light",
                    dataProvider: data,
                    titleField: "state",
                    valueField: "count",
                    export: {
                        enabled: true
                    }
                });
            } else {
                $('#deviceupstatuspercentall').addClass('my-auto');
                $('#deviceupstatuspercentall').text('Data unavailable or not relevant for this account');
            }
        }

        /**
         *
         * deviceUpStatusPercentAll
         *
         * get data for device up status percent all chart
         *
         * @param entity_id
         * @param el
         */
        function deviceUpStatusPercentAll(entity_id, el) {

            // setChartHW(el, '500px', '200px');

            let options = JSON.stringify({
                id: entity_id
            });

            return axios.get('/api/chart/deviceUpStatusPercentAll/' + options)
                .then(function (data) {

                if(!validate(data.data)){
                    return false;
                }

                chartDeviceUpStatusPercentAll(data.data);

            });
        }

        $(document).ready(function () {
            axiosrequests.push = deviceUpStatusPercentAll('{{$entity->id}}',$('#deviceupstatuspercentall'));
        });

    </script>

@endpush