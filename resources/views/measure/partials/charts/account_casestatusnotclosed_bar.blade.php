<div class="row m-1">
    <div class="col-lg-12 mt-2 text-white">
        <h5>Account Cases</h5>
    </div>
</div>
<div class="row" style="height: 200px;">
    <div class="col-lg-12 my-auto text-center">
        <img id="accountcases-loader" src="/img/bars.svg" height="70px"/>
        <div id="accountcases" class="chart-custom" style="display: none;"></div>
    </div>
</div>

@push('account_cases_chart')

<script>

    function chartAccountCases(data) {
        if (data !== false) {

            $('#accountcases-loader').css('display', 'none');
            $('#accountcases').css('display', 'block');

            AmCharts.makeChart("accountcases", {
                "type": "serial",
                "theme": "light",
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
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "pending on-site",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "pending on-site"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Hold- Awaiting Customer Response",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "Hold- Awaiting Customer Response"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "rma - requires netsuite entry update",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "rma - requires netsuite entry update"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "closed",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "closed"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "non support email",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "non support email"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "closed on first call",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "closed on first call"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "closed - sent back to sales rep",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "closed - sent back to sales rep"
                }, {
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

    /**
     *
     * accountCases
     *
     * get case data for account cases chart
     *
     * @param entity_id
     * @param el
     */
    function accountCases(entity_id, el) {
        setChartHW(el, '500px', '200px');

        let options = JSON.stringify({
            id: entity_id
        });

        return axios.get('/api/chart/accountcases/' + options).then(function(data){
            if(!validate(data.data)){
                return false;
            }

            chartAccountCases(data.data);
        })
    }

    $( document ).ready(function() {
        axiosrequests.push = accountCases('{{$entity->id}}', $('#accountcases'));
    });


</script>

@endpush


