/**
 * Created by amac on 6/24/17.
 */



$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: '/getRandomNumber',
        success: function (number) {

            let bgcolor;
            let bordercolor;

            let ctx = document.getElementById("myChart").getContext('2d');

            switch(number){
                case '1' :
                    bgcolor = 'rgba(230, 71, 89, .2)';
                    bordercolor = 'rgba(230, 71, 89, 1)';
                    break;

                case '2' :
                    bgcolor = 'rgba(27, 201, 142, .2)';
                    bordercolor = 'rgba(27, 201, 142, 1)';
                    break;

                case '3' :
                    bgcolor = 'rgba(159, 134, 255, .2)';
                    bordercolor = 'rgba(159, 134, 255, 1)';
                    break;

                case '4' :
                    bgcolor = 'rgba(228, 216, 54, .2)';
                    bordercolor = 'rgba(228, 216, 54, 1)';
                    break;

                case '5' :
                    bgcolor = 'rgba(28, 168, 221, .2)';
                    bordercolor = 'rgba(28, 168, 221, 1)';
                    break;
            }

            let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            bgcolor,
                        ],
                        borderColor: [
                            bordercolor,
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    });
});





