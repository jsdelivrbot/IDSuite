<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Protocol Breakdown</h5>
    </div>
</div>
<div class="row" style="height:200px;">
    <div class="col-lg-12 my-auto text-center text-white">
        <img id="protocolbreakout-loader" src="/img/bars.svg" height="70px"/>
        <div id="protocolbreakout" class="chart-custom text-white" style="display: none;"></div>
    </div>
</div>

@push('account_protocolbreakout_chart')

    <script>

        function chartProtocolBreakout(data) {

            let selected = undefined;

            $('#protocolbreakout-loader').css('display', 'none');
            $('#protocolbreakout').css('display', 'block');

            let is_valid = true;

            let total_count = 0;

            $.each(data, function (key, value){
                total_count = value.count + total_count;
            });

            if(total_count === 0){
                is_valid = false;
            }

            if (data !== false && data.length > 0 && is_valid) {

                AmCharts.makeChart("protocolbreakout", {
                    color: "#ffffff",
                    "type": "pie",
                    "theme": "light",
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

            } else {
                $('#protocolbreakout').parent().text('Data unavailable or not relevant for this account');
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

        /**
         *
         * protocolBreakout
         *
         * get data for protocol breakout chart
         *
         * @param entity_id
         * @param el
         */
        function protocolBreakout(entity_id, el) {
//            setChartHW(el, '500px', '200px');

            let options = JSON.stringify({
                id: entity_id
            });

            return axios.get('/api/chart/protocolbreakout/' + options)
                .then(function (data) {

                    if(!validate(data.data)){
                        return false;
                    }

                    chartProtocolBreakout(data.data)

            });
        }

        $(document).ready(function () {
            axiosrequests.push = protocolBreakout('{{$entity->id}}', $('#protocolbreakout'));
        });

    </script>

@endpush