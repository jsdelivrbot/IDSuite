<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Device Status Percentage</h5>
    </div>
    {{--<div class="col-lg-2">--}}
        {{--<button id="deviceupstatuspercentallbtn" onclick="buildChart()" class="btn btn-outline-pink m-1 float-right">--}}
            {{--<i id="deviceupstatuspercentallicon" class="fa fa-plus"></i>--}}
        {{--</button>--}}
    {{--</div>--}}
</div>
<div class="row">
    <div class="col-lg-8">
        <div  id="deviceupstatuspercentall"></div>
    </div>
</div>

@push('account_deviceupstatuspercent_chart')
<script src="https://www.amcharts.com/lib/3/pie.js"></script>

<script>


    $( document ).ready(function() {

        shrinkChart3();

    });

    function shrinkChart3(){

        $('#deviceupstatuspercentall').animate({
            width: '300px',
            height: '200px'
        }, 500);

        let chart = AmCharts.makeChart( "deviceupstatuspercentall", {
            "type": "pie",
            "theme": "dark",
            labelsEnabled: false,
            legend:{
                position: "right",
                marginRight: 10,
                autoMargins: false
            },
            "dataProvider": [ {
                "state": "Online",
                "count": 441
            }, {
                "state": "Offline",
                "count": 395
            } ],
            "valueField": "count",
            "titleField": "state",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 15,
            "innerRadius": "50%",
            "depth3D": 10,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 15,
            export: {
                enabled: true,
                menu: []
            }
        } );

        charts.push(chart);

    }

</script>

@endpush