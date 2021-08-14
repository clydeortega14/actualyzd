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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Chat Messages Channel
Broadcast::channel('new-message.{room_id}', function($room_id){
    return true;
});


// Video Call Channel
Broadcast::channel('video-call.{room_id}', function($room_id){
    return true;
});