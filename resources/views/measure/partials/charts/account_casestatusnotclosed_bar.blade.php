<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Account Cases</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="accountcases"></div>
    </div>
</div>

@push('account_cases_chart')

<script>

    $( document ).ready(function() {

        $('#accountcases').width('500px')
            .height('200px');

        $.ajax({
            type: "GET",
            url: '/api/accountcases',
            success: function (data) {

                if (data !== false) {

                    AmCharts.makeChart("accountcases", {
                        "type": "serial",
                        "theme": "dark",
                        "dataProvider": data,
                        "valueAxes": [{
                            "stackType": "regular",
                            "axisAlpha": 0.3,
                            "gridAlpha": 0
                        }],
                        "graphs": [{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "in progress",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "in progress"
                        }, {
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "re-opened",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "re-opened"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "pending on-site",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "pending on-site"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "Hold- Awaiting Customer Response",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "Hold- Awaiting Customer Response"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "rma - requires netsuite entry update",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "rma - requires netsuite entry update"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "closed",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "closed"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "non support email",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "non support email"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "closed on first call",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "closed on first call"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "closed - sent back to sales rep",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "closed - sent back to sales rep"
                        },{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "closed due to non response",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "closed due to non response"
                        }],
                        "categoryField": "type",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "gridAlpha": 0,
                            "position": "left"
                        },
                        "export": {
                            "enabled": true
                        }

                    });


                }
            }
        });
    });


</script>

@endpush


