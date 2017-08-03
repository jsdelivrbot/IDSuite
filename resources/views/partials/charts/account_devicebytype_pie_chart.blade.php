<div class="row m-1">
    <div class="col-lg-10 mt-2 text-white">
        <h5>Count of Devices By Type</h5>
    </div>
    <div class="col-lg-2">
        <button id="devicebytypebtn" onclick="buildChart()" class="btn btn-outline-pink m-1 float-right">
            <i id="devicebytypeicon" class="fa fa-plus"></i>
        </button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div  id="devicebytype"></div>
    </div>
</div>


@push('account_devicebytype_chart')
<script>

    $( document ).ready(function() {
        shrinkChart();
    });

    let globalchart;

    function shrinkChart(){

        $('#devicebytype').width('350px')
            .height('200px');

        $('#devicebytypebtn').attr("onclick", "buildChart()");

        $('#devicebytypeicon').removeClass()
            .addClass('fa fa-plus');

        let shrinkchart = AmCharts.makeChart( "devicebytype", {
            type: "pie",
            theme: "dark",
            labelsEnabled: false,
            legend:{
                position: "right",
                marginRight: 10,
                autoMargins: false
            },
            dataProvider: [ {
                name: "200i",
                value: 40
            }, {
                name: "200",
                value: 20
            }, {
                name: "Group 500",
                value: 10
            }, {
                name: "Group 700",
                value: 10
            }],
            valueField: "value",
            titleField: "name",
            balloon:{
                fixedPosition:true
            },
            export: {
                enabled: true,
                menu: []
            }
        });

        globalchart = shrinkchart;
    }

    let first = true;

    function buildChart() {
        $.ajax({
            type: "GET",
            url: '/api/deviceByType',
            dataType: 'json',
            success: function (data) {

                globalchart.clear();

                $('#devicebytype').width('1000px')
                    .height('800px');

                $('#devicebytypebtn').attr("onclick", "shrinkChart()");

                $('#devicebytypeicon').removeClass()
                    .addClass('fa fa-minus');


                if (data !== false) {

                    let chart = AmCharts.makeChart("devicebytype", {
                        type: "pie",
                        theme: "dark",
                        fontSize: 18,
                        color: '#000',
                        dataProvider: data,
                        labelsEnabled: false,
                        valueField: "value",
                        titleField: "name",
                        legend:{
                            position: "right",
                            marginRight: 100,
                            autoMargins: false
                        },
                        balloon: {
                            fixedPosition: true
                        },
                        export: {
                            enabled: true,
                            menu: []
                        }
                    });

                    chart.addListener("rendered", zoomChart);
                    if (chart.zoomChart) {
                        chart.zoomChart();
                    }

                    function zoomChart() {
                        chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
                    }

                    globalchart = chart;

                    charts.push(chart);
                }
            }
        });
    }


</script>
@endpush
