<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Protocol Breakdown</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="protocolbreakout"></div>
    </div>
</div>

@push('account_protocolbreakout_chart')

    <script>

        function chartProtocolBreakout(data) {

            let selected = undefined;

            console.log(data);

            if (data !== false) {

                AmCharts.makeChart("protocolbreakout", {
                    "type": "pie",
                    "theme": "dark",

                    "dataProvider": processChartData(data, selected),
                    "labelText": "[[title]]: [[value]]",
                    "balloonText": "[[title]]: [[value]]",
                    "titleField": "type",
                    "valueField": "percent",
                    "outlineColor": "#FFFFFF",
                    "outlineAlpha": 0.8,
                    "outlineThickness": 2,
                    "colorField": "color",
                    "pulledField": "pulled",
                    "listeners": [{
                        "event": "clickSlice",
                        "method": function (event) {
                            let chart = event.chart;
                            if (event.dataItem.dataContext.id !== undefined) {
                                selected = event.dataItem.dataContext.id;
                            } else {
                                selected = undefined;
                            }
                            chart.dataProvider = processChartData(data, selected);
                            chart.validateData();
                        }
                    }],
                    "export": {
                        "enabled": true
                    }
                });

            }
            return selected;
        }

        function processChartData(data, selected) {
            let chartData = [];
            for (let i = 0; i < data.length; i++) {
                if (i === selected) {
                    for (let x = 0; x < data[i].subtypes.length; x++) {
                        chartData.push({
                            type: data[i].subtypes[x].type,
                            percent: data[i].subtypes[x].percent,
                            pulled: true
                        });
                    }
                } else {
                    chartData.push({
                        type: data[i].type,
                        percent: data[i].percent,
                        id: i
                    });
                }
            }

            return chartData;
        }

        function protocolBreakout(el) {
            setChartHW(el);
            axios({
                type: 'get',
                url: '/api/protocolbreakout'
            }).then(function (data) {
                console.log(data.data);
                chartProtocolBreakout(data.data)
            });
        }

        $(document).ready(function () {
            protocolBreakout($('#protocolbreakout'));
        });

    </script>

@endpush