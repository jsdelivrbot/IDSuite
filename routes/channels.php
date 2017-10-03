<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('medsitter-call-status', function () {
    return true;
});


Broadcast::channel('medsitter-pods', function () {
    return true;
});


Broadcast::channel('medsitter-pod-count', function () {
    return true;
});

Broadcast::channel('medsitter-pod-key', function () {
    return true;
});