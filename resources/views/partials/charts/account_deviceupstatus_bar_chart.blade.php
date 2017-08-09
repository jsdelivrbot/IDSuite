<div class="row m-1">
    <div class="col-lg-10 mt-2 text-white">
        <h5>Count of Devices By Type</h5>
    </div>
    <div class="col-lg-2">
        <button id="deviceupstatusbtn" onclick="buildChart2()" class="btn btn-outline-pink m-1 float-right">
            <i id="deviceupstatusicon" class="fa fa-plus"></i>
        </button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="deviceupstatus"></div>
    </div>
</div>

@push('account_deviceupstatus_chart')

<script>

    $( document ).ready(function() {
        console.log('test');
        shrinkChart2();
    });

    let globalchart2;


    function shrinkChart2(){

        $('#deviceupstatus').width('350px')
            .height('200px');

        $('#deviceupstatusbtn').attr("onclick", "buildChart2()");

        $('#deviceupstatusicon').removeClass()
            .addClass('fa fa-plus');

        let shrinkchart = AmCharts.makeChart( "deviceupstatus", {
            type: "serial",
            startDuration: 2,
            theme: "dark",
            labelsEnabled: false,
            legend:{
                position: "right",
                marginRight: 10,
                autoMargins: false
            },
            dataProvider: [ {
                "country": "Canada",
                "visits": 441,
                "color": "#CD0D74"
            }, {
                "country": "Brazil",
                "visits": 395,
                "color": "#754DEB"
            }, {
                "country": "Italy",
                "visits": 386,
                "color": "#DDDDDD"
            }, {
                "country": "Australia",
                "visits": 384,
                "color": "#999999"
            }],
            valueAxes: [{
                position: "left",
                title: "Visitors"
            }],
            graphs: [{
                balloonText: "[[category]]: <b>[[value]]</b>",
                fillColorsField: "color",
                fillAlphas: 1,
                lineAlpha: 0.1,
                type: "column",
                valueField: "visits"
            }],
            depth3D: 20,
            angle: 30,
            chartCursor: {
                categoryBalloonEnabled: false,
                cursorAlpha: 0,
                zoomable: false
            },
            categoryField: "country",
            categoryAxis: {
                gridPosition: "start",
                labelRotation: 90
            },
            export: {
                enabled: true,
                menu: []
            }
        });

        globalchart2 = shrinkchart;
    }

    let first2 = true;

    function buildChart2() {
        $.ajax({
            type: "GET",
            url: '/api/deviceUpStatusAll',
            success: function (data) {

                if (data !== false) {

                    let chart = AmCharts.makeChart("chartdiv", {
                        theme: "light",
                        type: "serial",
                        startDuration: 2,
                        dataProvider: data,
                        labelsEnabled: false,
                        legend: {
                            useGraphSettings: true
                        },
                        graphs: [{
                            balloonText: "[[category]]: <b>[[value]]</b>",
                            fillColorsField: "color",
                            fillAlphas: 1,
                            lineAlpha: 0.1,
                            type: "column",
                            valueField: "visits"
                        }],
                        depth3D: 20,
                        angle: 30,
                        chartCursor: {
                            categoryBalloonEnabled: false,
                            cursorAlpha: 0,
                            zoomable: false
                        },
                        categoryField: "country",
                        categoryAxis: {
                            gridPosition: "start",
                            labelRotation: 90
                        },
                        export: {
                            enabled: true,
                            menu: []
                        }

                    });


                }
            }
        });
    }

</script>

@endpush