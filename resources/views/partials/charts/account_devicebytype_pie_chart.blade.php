<canvas id="devicebytype"></canvas>

@push('account_devicebytype_chart')
<script>

    $( document ).ready(function() {
        $.ajax({
            type: "GET",
            url: '/api/deviceByType',
            success: function (data) {

                if (data !== false) {

                    let names = data.names;

                    let values = data.values;

                    console.log(names);
                    console.log(values);

                    let devicebytype = document.getElementById("devicebytype").getContext('2d');

                    let myChart = new Chart(devicebytype, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: values,
                                backgroundColor: [
                                    'rgba(230, 71, 89, .2)',
                                    'rgba(27, 201, 142, .2)',
                                    'rgba(159, 134, 255, .2)',
                                    'rgba(228, 216, 54, .2)',
                                    'rgba(28, 168, 221, .21)',
                                    'rgba(28, 168, 221, .21)',
                                    'rgba(28, 168, 221, .21)'
                                ],
                                borderColor: [
                                    'rgba(230, 71, 89, 1)',
                                    'rgba(27, 201, 142, 1)',
                                    'rgba(159, 134, 255, 1)',
                                    'rgba(228, 216, 54, 1)',
                                    'rgba(28, 168, 221, 1)',
                                    'rgba(28, 168, 221, 1)',
                                    'rgba(28, 168, 221, 1)'
                                ],
                            }],
                            labels: names
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Devices by Type',
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
