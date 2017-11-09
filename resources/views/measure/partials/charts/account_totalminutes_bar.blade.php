<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Total Call Duration</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="totalcallduration"></div>
    </div>
</div>

@push('account_totalcallminutes_chart')

<script>

    function chartTotalCallDuration(data) {
        if (data !== false) {

            AmCharts.makeChart("totalcallduration", {
                type: "serial",
                startDuration: 2,
                theme: "dark",
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
        }
    }

    function totalCallDuration(el) {
        setChartHW(el, '500px', '200px');

        axios({
            type: 'get',
            url: '/api/totalcallduration'
        }).then(function (data) {
            console.log(data.data);

            chartTotalCallDuration(data.data);

        });
    }

    $( document ).ready(function() {
        totalCallDuration($('#totalcallduration'));
    });


</script>

@endpush