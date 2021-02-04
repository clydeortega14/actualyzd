<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GuestsController@index')->name('guests.home');

Route::get('/guest-clients', 'GuestsController@clients')->name('guest.clients');

Route::post('/guest-clients', 'GuestsController@store')->name('guest.clients.store');

Route::get('/careers', 'CareersController@index')->name('careers.index');

Route::post('/careers', 'CareersController@store')->name('careers.store');

Route::get('/contact-us', 'GuestsController@contactUs')->name('contact.us');

Auth::routes();

/* For Authenticated Users Only*/
Route::middleware('auth')->group(function(){

	Route::get('/home', 'HomeController@index')->name('home');

	// Clients Routes
	Route::resource('clients', 'ClientsController');

	// Psychologists
	Route::resource('psychologists', 'PsychologistsController');

	// Psychologists Ajax Request
	Route::post('async/activate-psychologist', 'PsychologistsController@activate');

	// Schedules
	Route::get('schedules', 'SchedulesController@index')->name('schedules.index');

	// Book now
	Route::get('book-a-schedule', 'SchedulesController@bookSchedule')->name('book.now');

	// Show Schedule
	Route::get('show-schedule', 'SchedulesController@show')->name('schedule.show');

});

