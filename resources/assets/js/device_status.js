/**
 * Created by amac on 6/28/17.
 */
$.ajax({
    type: "GET",
    url: '/getDeviceStatus',
    success: function (data) {

        if(data === true){
            var canvas = document.getElementById('device-status-circle');
            var context = canvas.getContext('2d');
            var centerX = canvas.width / 2;
            var centerY = canvas.height / 2;
            var radius = 10;

            context.beginPath();
            context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
            context.fillStyle = 'rgba(27, 201, 142, .3)';
            context.fill();
            context.lineWidth = 2;
            context.strokeStyle = 'rgba(27, 201, 142, 1)';
            context.stroke();
        } else {

            var canvas = document.getElementById('device-status-circle');
            var context = canvas.getContext('2d');
            var centerX = canvas.width / 2;
            var centerY = canvas.height / 2;
            var radius = 10;

            context.beginPath();
            context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
            context.fillStyle = 'rgba(230, 71, 89, .3)';
            context.fill();
            context.lineWidth = 2;
            context.strokeStyle = 'rgba(230, 71, 89, 1)';
            context.stroke();

        }

    }
});