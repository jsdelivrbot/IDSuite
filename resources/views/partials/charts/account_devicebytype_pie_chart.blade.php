<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Count of Devices By Type</h5>
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

        $('#devicebytype').width('500px')
            .height('200px');

        $.ajax({
            type: "GET",
            url: '/api/deviceByType',
            dataType: 'json',
            success: function (data) {

                if (data !== false) {

                    AmCharts.makeChart("devicebytype", {
                        type: "pie",
                        theme: "dark",
                        fontSize: 18,
                        color: '#000',
                        dataProvider: data,
                        labelsEnabled: false,
                        valueField: "value",
                        titleField: "name",
                        balloon: {
                            fixedPosition: true
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
