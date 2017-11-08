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

        function deviceByType(el) {

            setChartHW(el);

            axios({
                type: "get",
                url: '/api/deviceByType'
            }).then(function (data) {

                chartDeviceByType(data.data);

            });
        }

        $(document).ready(function () {
            deviceByType($('#devicebytype'));
        });


    </script>

@endpush
