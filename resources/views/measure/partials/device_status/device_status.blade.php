<canvas id="device-status-circle" class="ml-2" width="30" height="25" data-toggle="tooltip" data-placement="top" title="Status"></canvas>

@push('device_status')

<script>

    function setDeviceStatus(response, canvas) {

        if (response === true) {

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

    function getDeviceStatus(endpoint_id, canvas) {

        let options = JSON.stringify({
            id: endpoint_id
        });

        axios.get('/api/endpoint/getDeviceStatus/' + options)
            .then(function (data) {
                let response = data.data;
                if(!validate(response)){
                    return false;
                }
                setDeviceStatus(response, canvas);
            })
    }

    $( document ).ready(function() {

        let canvas = document.getElementById('device-status-circle');

        axiosrequests.push = getDeviceStatus('{{$endpoint->id}}', canvas);

    });

</script>

@endpush