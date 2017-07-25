<canvas id="deviceupstatuspercentall"></canvas>

@push('account_deviceupstatuspercent_chart_script')

<script>

    $( document ).ready(function() {
        $.ajax({
            type: "GET",
            url: '/getChartDeviceUpStatusPercentAll',
            success: function (data) {

                if(data !== false) {

                    let status = data.status;

                    let deviceupstatuspercentall = document.getElementById("deviceupstatuspercentall").getContext('2d');

                    let myChart = new Chart(deviceupstatuspercentall, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: status,
                                backgroundColor: [
                                    'rgba(27, 201, 142, .2)',
                                    'rgba(230, 71, 89, .2)'
                                ],
                                borderColor: [
                                    'rgba(27, 201, 142, 1)',
                                    'rgba(230, 71, 89, 1)'
                                ],
                            }],
                            labels: [
                                "Devices Up",
                                "Devices Down"
                            ]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Current Device Statuses',
                                fontColor: 'rgba(255,255,255,1)',
                                fontSize: 24
                            },
                            tooltips: {
                                callbacks: {
                                    label: function (tooltipItem, data) {
                                        let dataset = data.datasets[tooltipItem.datasetIndex];

                                        let dataitem = dataset.data[tooltipItem.index];

                                        return dataitem + "%";
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    });

</script>

@endpush