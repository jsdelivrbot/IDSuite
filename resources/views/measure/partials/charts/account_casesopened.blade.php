<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Cases Opened</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="casesopened"></div>
    </div>
</div>

@push('account_casesopened_chart')

<script>

    function chartCasesOpened(data) {
        if (data !== false) {

            AmCharts.makeChart("casesopened", {
                type: "serial",
                startDuration: 2,
                theme: "dark",
                labelsEnabled: false,
                dataProvider: data,
                valueAxes: [{
                    position: "left",
                    title: "Avg Minutes"
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
                    enabled: true,
                }
            });
        }
    }

    function casesOpened(el) {
        setChartHW(el, '500px', '200px');
        axios({
            type: 'get',
            url: '/api/casesopened'
        }).then(function (data) {

            if(!validate(data.data)){
                return false;
            }

            chartCasesOpened(data.data);
        });
    }

    $( document ).ready(function() {
        casesOpened($('#casesopened'));
    });

</script>

@endpush