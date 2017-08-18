<div class="row m-1">
    <div class="col-lg-10 mt-2 text-white">
        <h5>Device Status</h5>
    </div>
    <div class="col-lg-2">
        {{--<button id="deviceupstatusbtn" onclick="buildChart2()" class="btn btn-outline-pink m-1 float-right">--}}
            {{--<i id="deviceupstatusicon" class="fa fa-plus"></i>--}}
        {{--</button>--}}
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

//        $('#deviceupstatusbtn').attr("onclick", "buildChart2()");
//
//        $('#deviceupstatusicon').removeClass()
//            .addClass('fa fa-plus');

        let chart = AmCharts.makeChart( "deviceupstatus", {
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
                "state": "Up",
                "count": 441,
                "color": "#008000"
            }, {
                "state": "Down",
                "count": 395,
                "color": "#FF0000"
            }],
            valueAxes: [{
                position: "left",
                title: "Count"
            }],
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
                enabled: true,
                menu: []
            }
        });

        charts.push(chart);

//        globalchart2 = shrinkchart;
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