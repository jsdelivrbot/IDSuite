<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Device Status Percentage</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div id="deviceupstatuspercentall"></div>
    </div>
</div>

@push('account_deviceupstatuspercent_chart')

    <script src="https://www.amcharts.com/lib/3/pie.js"></script>

    <script>

        function chartDeviceUpStatusPercentAll(data) {
            AmCharts.makeChart("deviceupstatuspercentall", {
                type: "pie",
                theme: "dark",
                dataProvider: data,
                titleField: "state",
                valueField: "count",
                export: {
                    enabled: true
                }
            });
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

            setChartHW(el, '500px', '200px');

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