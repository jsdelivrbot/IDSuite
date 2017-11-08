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

        function deviceUpStatusPercentAll(el) {

            setChartHW(el);
            axios({
                type: 'get',
                url: '/api/deviceUpStatusPercentAll'
            }).then(function (data) {
                console.log(data.data);

                chartDeviceUpStatusPercentAll(data.data);

            });
        }

        $(document).ready(function () {
            deviceUpStatusPercentAll($('#deviceupstatuspercentall'));
        });

    </script>

@endpush