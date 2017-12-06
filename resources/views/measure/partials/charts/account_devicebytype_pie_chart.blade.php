<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Count of Devices By Type</h5>
    </div>
</div>
<div class="row" style="height: 200px">
    <div class="col-lg-12 my-auto text-center text-white">
        <img id="devicebytype-loader" src="/img/bars.svg" height="70px"/>
        <div id="devicebytype" class="chart-custom text-white" style="display: none;"></div>
    </div>
</div>


@push('account_devicebytype_chart')

    <script>


        function chartDeviceByType(data) {

            $('#devicebytype-loader').css('display', 'none');
            $('#devicebytype').css('display', 'block');

            if (data !== false && data.length > 0) {

                AmCharts.makeChart("devicebytype", {
                    type: "pie",
                    theme: "light",
                    fontSize: 18,
                    color: '#ffffff',
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

            } else {
                $('#devicebytype').parent().text('Data unavailable or not relevant for this account');
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

//            setChartHW(el, '500px', '200px');

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
