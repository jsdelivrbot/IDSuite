<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Total Call Duration</h5>
    </div>
</div>
<div class="row" style="height: 200px">
    <div class="col-lg-12 my-auto text-center">
        <img id="totalcallduration-loader" src="/img/bars.svg" height="70px"/>
        <div id="totalcallduration" class="chart-custom text-white" style="display: none;"></div>
    </div>
</div>

@push('account_totalcallminutes_chart')

<script>

    function chartTotalCallDuration(data) {

        $('#totalcallduration-loader').css('display', 'none');
        $('#totalcallduration').css('display', 'block');

        if (data !== false && data.length > 0) {

            AmCharts.makeChart("totalcallduration", {
                type: "serial",
                startDuration: 2,
                theme: "light",
                labelsEnabled: false,
                dataProvider: data,
                valueAxes: [{
                    position: "left",
                    title: "Minutes"
                }],
                graphs: [{
                    balloonText: "[[category]]: <b>[[value]]</b>",
                    fillColorsField: "color",
                    fillAlphas: 1,
                    lineAlpha: 0.1,
                    type: "column",
                    valueField: "value"
                }],
                depth3D: 20,
                angle: 30,
                chartCursor: {
                    categoryBalloonEnabled: false,
                    cursorAlpha: 0,
                    zoomable: false
                },
                categoryField: "date_string",
                categoryAxis: {
                    gridPosition: "start",
                    labelRotation: 90
                },
                export: {
                    enabled: true
                }
            });
        } else {
            $('#totalcallduration').text('Data unavailable or not relevant for this account');
        }
    }

    /**
     *
     * totalCallDuration
     *
     * gets data for total call duration chart
     *
     * @param entity_id
     * @param el
     */
    function totalCallDuration(entity_id, el) {

        setChartHW(el, '500px', '200px');

        let options = JSON.stringify({
            id: entity_id,
            start_time: 2017
        });

        return axios.get('/api/chart/totalcallduration/' + options)
            .then(function (data) {

                if(!validate(data.data)){
                    return false;
                }

                chartTotalCallDuration(data.data);
        });
    }

    $( document ).ready(function() {
        axiosrequests.push = totalCallDuration('{{$entity->id}}',$('#totalcallduration'));
    });


</script>

@endpush