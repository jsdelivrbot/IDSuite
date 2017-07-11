/**
 * Created by amac on 7/10/17.
 */



$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: '/getChartDeviceCostPerCallAvg',
        success: function (result) {

            let labels = result.labels;

            let data = result.data;

            let devicecallcostavg = document.getElementById("devicecallcostavg").getContext('2d');

            let myChart = new Chart(devicecallcostavg, {
                type: 'line',
                data: {
                    datasets: [{
                        data: data,
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
                    labels: labels
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Device Cost Per Call Average',
                        fontColor: 'rgba(255,255,255,1)',
                        fontSize: 24
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value, index, values) {
                                    return value.toLocaleString("en-US",{style:"currency", currency:"USD"});
                                }
                            }
                        }]
                    }
                }
            });
        }
    });
});





