/**
 * Created by amac on 6/28/17.
 */
/**
 * Created by amac on 6/24/17.
 */



$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: '/getChartDeviceByType',
        success: function (data) {

            let names = data.names;

            let values = data.values;

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
    });

    $.ajax({
        type: "GET",
        url: '/getChartDeviceUpStatusAll',
        success: function (data) {

            let status = data.status;

            let value = data.value;

            let devicebystatus = document.getElementById("deviceupstatus").getContext('2d');

            let myChart = new Chart(devicebystatus, {
                type: 'bar',
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
    });


    $.ajax({
        type: "GET",
        url: '/getChartDeviceUpStatusPercentAll',
        success: function (data) {

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
                            label: function(tooltipItem, data) {
                                let dataset = data.datasets[tooltipItem.datasetIndex];

                                let dataitem = dataset.data[tooltipItem.index];

                                return dataitem + "%";
                            }
                        }
                    }
                }
            });
        }
    });
});





