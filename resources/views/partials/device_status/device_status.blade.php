<canvas id="device-status-circle" class="ml-2" width="30" height="25" data-toggle="tooltip" data-placement="top" title="Status"></canvas>

@push('device_status')

<script>

    $( document ).ready(function() {
        $.ajax({
            type: "GET",
            url: '/getDeviceStatus',
            success: function (data) {

                if (data === true) {
                    let canvas = document.getElementById('device-status-circle');
                    let context = canvas.getContext('2d');
                    let centerX = canvas.width / 2;
                    let centerY = canvas.height / 2;
                    let radius = 10;

                    context.beginPath();
                    context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
                    context.fillStyle = 'rgba(27, 201, 142, .3)';
                    context.fill();
                    context.lineWidth = 2;
                    context.strokeStyle = 'rgba(27, 201, 142, 1)';
                    context.stroke();
                } else {

                    let canvas = document.getElementById('device-status-circle');
                    let context = canvas.getContext('2d');
                    let centerX = canvas.width / 2;
                    let centerY = canvas.height / 2;
                    let radius = 10;

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
    });

</script>

@endpush