<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Device Status</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="deviceupstatus"></div>
    </div>
</div>

@push('account_deviceupstatus_chart')

<script>

    function chartDeviceUpStatus(data) {
        if (data !== false) {

            AmCharts.makeChart("deviceupstatus", {
                theme: "light",
                type: "serial",
                startDuration: 2,
                dataProvider: data,
                labelsEnabled: false,
                graphs: [{
                    balloonText: "[[category]]: <b>[[value]]</b>",
                    fillColorsField: "color",
                    fillAlphas: 1,
                    lineAlpha: 0.1,
                    type: "column",
                    valueField: "count"
                }],
                depth3D: 20,
                angle: 30,
                chartCursor: {
                    categoryBalloonEnabled: false,
                    cursorAlpha: 0,
                    zoomable: false
                },
                categoryField: "state",
                categoryAxis: {
                    gridPosition: "start",
                    labelRotation: 90
                },
                export: {
                    enabled: true
                }

            });


        }
    }

    /**
     *
     * deviceUpStatusAll
     *
     * gets data to build device up status all chart
     *
     * @param entity_id
     * @param el
     */
    function deviceUpStatusAll(entity_id, el) {

        setChartHW(el, '500px', '200px');

        let options = JSON.stringify({
            id: entity_id
        });

        return axios.get('/api/chart/deviceUpStatusAll/' + options)
            .then(function (data) {

                if(!validate(data.data)){
                    return false;
                }

                chartDeviceUpStatus(data.data);

            });
    }

    $( document ).ready(function() {

        axiosrequests.push = deviceUpStatusAll('{{$entity->id}}',$('#deviceupstatus'));

    });

</script>

@endpush