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

Route::get('/careers', 'GuestsController@careers')->name('careers.index');

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

});

