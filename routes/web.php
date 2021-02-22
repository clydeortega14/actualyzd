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

	// Schedules
	Route::get('schedules', 'SchedulesController@index')->name('schedules.index');

	// Book now
	Route::get('book-a-schedule', 'SchedulesController@bookSchedule')->name('book.now');
	// Show Schedule
	Route::get('show-schedule', 'SchedulesController@show')->name('schedule.show');
	// create my schedule
	Route::prefix('psychologist')->group(function(){

		Route::get('schedules', 'SchedulesController@getSchedules')->name('psychologist.get.schedule');

		Route::post('schedule', 'SchedulesController@storeSchedule')->name('psychologist.store.schedule');

		Route::post('delete-schedule', 'SchedulesController@delete')->name('psychologist.delete.schedule');

	});

});

