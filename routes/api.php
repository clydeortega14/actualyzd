<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('photo', 'UsersController@uploadAvatar');
});


/*-- Reason Option Route -- */
Route::get('get-reasons-lists', 'Api\ReasonController@index');
    
/*-- Booking Route Group -- */
Route::prefix('booking')->group(function(){

    /* -- Submit Reschedule Booking Route -- */
    Route::post('reschedule', 'Api\BookingController@reschedule');

});

// Chat Messages API
Route::get('chat-messages/{room_id}', 'Api\ChatMessageController@chatMessages');

Route::post('chat-message', 'Api\ChatMessageController@store');
