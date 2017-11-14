<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Count of Devices By Type</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="devicebytype"></div>
    </div>
</div>


@push('account_devicebytype_chart')

    <script>


        function chartDeviceByType(data) {
            if (data !== false) {
                AmCharts.makeChart("devicebytype", {
                    type: "pie",
                    theme: "dark",
                    fontSize: 18,
                    color: '#000',
                    dataProvider: data,
                    labelsEnabled: false,
                    valueField: "value",
                    titleField: "name",
                    balloon: {
                        fixedPosition: true
                    },
                    export: {
                        enabled: true
                    }
                });

            }
        }

        /**
         *
         * deviceByType
         *
         * used to get data for device by type chart.
         *
         * @param entity_id
         * @param el
         */
        function deviceByType(entity_id, el) {

            setChartHW(el, '500px', '200px');

            let options = JSON.stringify({
                id: entity_id
            });

            return axios.get('/api/chart/deviceByType/' + options)
                .then(function (data) {

                    if(!validate(data.data)){
                        return false;
                    }

                    chartDeviceByType(data.data);

                });
        }

        $(document).ready(function () {
            axiosrequests.push = deviceByType('{{$entity->id}}', $('#devicebytype'));
        });


    </script>

@endpush
