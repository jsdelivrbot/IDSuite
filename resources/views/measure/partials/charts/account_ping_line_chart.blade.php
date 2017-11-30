<div id="ping-line-chart"></div>

@push('account_ping_line_chart')

<script>

    $( document ).ready(function() {
        $.ajax({
            type: "GET",
            url: '/api/deviceUpStatusAll',
            success: function (data) {

                if (data !== false) {



                    let status = data.status;

                    let value = data.value;

                    let devicebystatus = document.getElementById("deviceupstatus").getContext('2d');

                    let myChart = new Chart(devicebystatus, {
                        type: 'bar',
                        theme: 'light',
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
                            }
                        }
                    });
                }
            }
        });
    });

</script>

@endpush