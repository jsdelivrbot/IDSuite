<canvas id="devicecallcostavg"></canvas>

@push('device_devicecostperavg_chart')
<script>
    function deviceCostPerCallAvg(data, labels, el) {

//        let myChart = new Chart(el, {
//            type: 'line',
//            data: {
//                datasets: [{
//                    data: data,
//                    backgroundColor: [
//                        'rgba(230, 71, 89, .2)',
//                        'rgba(27, 201, 142, .2)',
//                        'rgba(159, 134, 255, .2)',
//                        'rgba(228, 216, 54, .2)',
//                        'rgba(28, 168, 221, .21)',
//                        'rgba(28, 168, 221, .21)',
//                        'rgba(28, 168, 221, .21)'
//                    ],
//                    borderColor: [
//                        'rgba(230, 71, 89, 1)',
//                        'rgba(27, 201, 142, 1)',
//                        'rgba(159, 134, 255, 1)',
//                        'rgba(228, 216, 54, 1)',
//                        'rgba(28, 168, 221, 1)',
//                        'rgba(28, 168, 221, 1)',
//                        'rgba(28, 168, 221, 1)'
//                    ],
//                }],
//                labels: labels
//            },
//            options: {
//                responsive: true,
//                title: {
//                    display: true,
//                    text: 'Device Cost Per Call Average',
//                    fontColor: 'rgba(255,255,255,1)',
//                    fontSize: 24
//                },
//                scales: {
//                    yAxes: [{
//                        ticks: {
//                            callback: function (value, index, values) {
//                                return value.toLocaleString("en-US", {style: "currency", currency: "USD"});
//                            }
//                        }
//                    }]
//                }
//            }
//        });
    }

    function getDeviceCostPerCallAvg(endpoint_id, el) {

        let options = JSON.stringify({
            id: endpoint_id
        });

        return axios.post('/api/chart/deviceCostPerCallAvg/' + options)
            .then(function (response) {

                let data = response.data;

                if (!validate(data)) {
                    return false;
                }

                let labels = data.labels;

                let chart_data = data.data;

                deviceCostPerCallAvg(chart_data, labels, el);

            });
    }

    $( document ).ready(function() {
       axiosrequests.push = getDeviceCostPerCallAvg('{{$endpoint->id}}', document.getElementById("devicecallcostavg").getContext('2d'));
    });
</script>

@endpush