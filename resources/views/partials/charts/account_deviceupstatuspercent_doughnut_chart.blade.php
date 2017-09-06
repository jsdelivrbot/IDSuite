<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Device Status Percentage</h5>
    </div>
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

        $('#deviceupstatuspercentall').width('500px')
            .height('200px');

        $.ajax({
            type: "GET",
            url: '/api/deviceUpStatusPercentAll',
            success: function(data){

                console.log(data);

                AmCharts.makeChart( "deviceupstatuspercentall", {
                    type: "pie",
                    theme: "dark",
                    dataProvider: data,
                    titleField: "state",
                    valueField: "count",
                    export: {
                        enabled: true
                    }
                });

//
//                AmCharts.makeChart("devicebytype", {
//                    type: "pie",
//                    theme: "dark",
//                    dataProvider: data,
//                    valueField: "value",
//                    titleField: "name",
//                    balloon: {
//                        fixedPosition: true
//                    },
//                    export: {
//                        enabled: true
//                    }
//                });
            }
        });

    });

</script>

@endpush