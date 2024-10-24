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


/*
 * Service Utilization Concerns Chart
 *
*/
Route::post('consultations/chart/data', 'Api\ConsultationsChartController@getConsultations');


// Client Subscriptions
Route::post('client/subscriptions', 'Api\ClientSubscriptionController@clientSubscriptions');

// Cancel Subscription
Route::post('update/client/subscription', 'Api\ClientSubscriptionController@updateClientSubscription');

// Renew Subscriptin
Route::post('renew/client/subscriptions', 'Api\ClientSubscriptionController@renewClientSubscription');


/*-- Reason Option Route -- */
Route::get('get-reasons-lists', 'Api\ReasonController@index');
    
/*-- Booking Route Group -- */
Route::prefix('booking')->group(function(){
    
    /* -- Submit Reschedule Booking Route -- */
    Route::post('reschedule', 'Api\BookingController@reschedule');
});

Route::get('show/booking/{booking_id}', 'Api\BookingController@showBooking');

// Chat Messages API
Route::get('chat-messages/{room_id}', 'Api\ChatMessageController@chatMessages');

Route::post('chat-message', 'Api\ChatMessageController@store');

// Re assign session api
Route::post('reassign/session', 'Api\SessionController@reassign');

// Scheduled Sessions API
Route::get('scheduled/sessions', 'Api\SessionController@scheduledSessions');

// Booking History API
Route::get('booking/history', 'Api\BookingController@bookingHistory');

