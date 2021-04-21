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

// Route::get('/', 'GuestsController@index')->name('guests.home');
Route::get('/', function(){
	return view('auth.login');
});

Route::get('/guest-clients', 'GuestsController@clients')->name('guest.clients');

Route::post('/guest-clients', 'GuestsController@store')->name('guest.clients.store');

Route::get('/careers', 'CareersController@index')->name('careers.index');

Route::post('/careers', 'CareersController@store')->name('careers.store');

Route::get('/contact-us', 'GuestsController@contactUs')->name('contact.us');

Auth::routes();

/* For Authenticated Users Only*/
Route::middleware('auth')->group(function(){

	Route::get('/home', 'HomeController@index')->middleware('check-role')->name('home');

	// Clients Routes
	Route::resource('clients', 'ClientsController');

	// Psychologists
	Route::resource('psychologists', 'PsychologistsController');

	// Users
	Route::resource('users', 'UsersController');

	/*--- All Set Ups ---*/
	Route::prefix('set-up')->group(function(){

		// Roles
		Route::resource('roles', 'RolesController');
		
		// Permissions
		Route::resource('permissions', 'PermissionsController');

		// Timelists
		Route::resource('time-lists', 'TimeListsController');

		// Assessment Groups
		Route::prefix('assessment')->group(function(){

			// Categories
			Route::resource('categories', 'AssessmentCategoryController');

			// Questionnaires
			Route::resource('questionnaires', 'QuestionnaireController');

			// Options
			Route::resource('options', 'AssessmentOptionController');

		});

	});

	// Schedules
	Route::get('schedules', 'SchedulesController@index')->name('schedules.index');

	// Show Schedule
	Route::get('show-schedule', 'SchedulesController@show')->name('schedule.show');

	// Get time by date selected in calendar
	Route::get('time-by-schedule/{schedule}', 'SchedulesController@getTimeBySchedule');

	// Get onboarding questionnaires in ajax request
	Route::get('onboarding-questions', 'AssessmentCategoryController@questionnaires');

	/* Pyschologist Prefix */
	Route::prefix('psychologist')->group(function(){

		Route::get('/', 'PsychologistsController@home')->name('psychologist.home');

		Route::get('schedules', 'SchedulesController@getSchedules')->name('psychologist.get.schedule');

		Route::post('schedule', 'SchedulesController@storeSchedule')->name('psychologist.store.schedule');

		Route::post('delete-schedule', 'SchedulesController@delete')->name('psychologist.delete.schedule');

		// Ajax
		Route::get('time-schedules', 'SchedulesController@timeSchedule')->name('psychologist.time.schedule');

		Route::get('available/{time}', 'SchedulesController@psychologists')->name('psychologist.available');
	});


	/* Member Prefix */
	Route::prefix('member')->group(function(){

		Route::get('/', 'MemberController@home')->name('member.home');
	});


	Route::prefix('bookings')->group(function(){

		Route::get('/', 'BookingController@index')->name('bookings.index');

		Route::get('/create', 'BookingController@create')->name('bookings.create');

		Route::get('cancel/{booking}', 'BookingController@cancel')->name('booking.cancel');

		Route::get('reschedule/{booking}', 'BookingController@reschedule')->name('booking.reschedule');

		Route::get('answered-questions/{booking}', 'BookingController@getAssessment')->name('booking.answered.questions');

		// Actions
		Route::post('book', 'BookingController@bookNow')->name('book.now');

		Route::post('cancel/{booking}', 'BookingController@updateToCancel')->name('cancel.booking');

		Route::put('reschedule/{booking}', 'BookingController@reschedBooking')->name('booking.reschedule.update');
	});

});

