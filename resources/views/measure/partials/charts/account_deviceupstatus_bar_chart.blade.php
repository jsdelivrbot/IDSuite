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

    $( document ).ready(function() {

        $('#deviceupstatus').width('500px')
            .height('200px');

        $.ajax({
            type: "GET",
            url: '/api/deviceUpStatusAll',
            success: function (data) {

                console.log(data)


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
        });
    });

</script>

@endpush