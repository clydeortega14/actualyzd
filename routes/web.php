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

Route::prefix('guests')->group(function(){

	Route::get('applying-clients', 'GuestsController@clients')->name('guests.clients');

	Route::get('applying-individual', 'GuestsController@applyingIndividual')->name('guests.applying.individual');

	Route::post(
		'applying-individual-store', 
		'GuestsController@storeApplyingIndividual'
	)
	->name('guests.store.applying.individual');
});

// Route::get('/guest-clients', 'GuestsController@clients')->name('guest.clients');

Route::post('/guest-clients', 'GuestsController@store')->name('guest.clients.store');

Route::get('/careers', 'CareersController@index')->name('careers.index');

Route::post('/careers', 'CareersController@store')->name('careers.store');

Route::get('/contact-us', 'GuestsController@contactUs')->name('contact.us');

Auth::routes(['verify' => true]);

/* For Authenticated Users Only*/
Route::middleware(['auth', 'verified'])->group(function(){

	Route::get('/home', 'HomeController@index')->middleware('check-role')->name('home');

	Route::get('service-utilization-dashboard', 'HomeController@serviceUtilizationDashboard')->name('service.utilization.dashboard');

	// Clients Routes
	Route::resource('clients', 'ClientsController');

	// Client System Users
	Route::get('client/{client}/users', 'ClientsController@showClientUsers')->name('client.show.users');

	// Client Subscription
	Route::get('client/{client}/subscription', 'ClientsController@showSubscription')->name('client.show.subscription');

	// Add client subscription
	Route::get('subscriptions/{client}', 'ClientsController@subscriptions')->name('client.subscriptions');

	// Renew Client Subscription
	Route::post('client/subscription/renew', 'ClientsController@renew')->name('client.subscription.renew');

	// Store client subscription
	Route::post('client-subscription', 'ClientsController@addSubscription')->name('add.client.subscription');

	// Billing Module
	Route::prefix('billings')->group(function(){

		// Billings Index
		Route::get('client/{client}', 'BillingController@clientBilling')->name('client.billings');

		Route::get('client/{invoice_no}/payments', 'PaymentController@index')->name('client.billing.payments');
	});

	// Payments Module Group
	Route::prefix('payments')->group(function(){
		Route::get('/', 'PaymentController@show')->name('payments.show');
	});
	
	// Client Users Route
	Route::get('client-users/{client}', 'ClientsController@clientUsers');

	Route::get('clients-with-users', 'ClientsController@clientsWithUsers');

	Route::get('session-types', 'SessionTypeController@allSessions');

	/**
	 * Ajax Requests for Service Utilization Dashboard
	 * For superadmin all service utilizations
	 * and for each client
	 */
	Route::get('service/utilizations', 'ServiceUtilizationController@dashboard');

	// Psychologists
	Route::resource('psychologists', 'PsychologistsController');

	// Users
	Route::resource('users', 'UsersController');

	// Import company Users
	Route::post('import_excel', 'UsersController@import_excel')->name('import.comapany_users');
	// Export company Users
	Route::get('export_users', 'UsersController@export_employee')->name('export.comapany_users');

	//Company Information or Profile
	Route::resource('company_info', 'CompanyInfoController');
	Route::post('company_info_update', 'CompanyInfoController@update')->name('update.comapany_info');
	Route::post('modal_logo_update', 'CompanyInfoController@update_companyLogo')->name('update.comapany_logo');

	// User Profile
	Route::get('profile/{username}', 'UsersController@profile')->name('user.profile');
	Route::get('profile/{user}/edit', 'UsersController@editProfile')->name('user.profile.edit');
	Route::put('profile/{user}', 'UsersController@updateProfile')->name('user.profile.update');
	Route::put('profile/{user}/change-password', 'UsersController@updatePassword')->name('user.profile.updatePassword');

	/*--- All Set Ups ---*/
	Route::prefix('set-up')->group(function(){

		// Home
		Route::get('/', 'HomeController@setUps')->name('setups.home');

		// Access Rights
		Route::get('access-rights', 'HomeController@accessRights')->name('access.rights');

		// Roles
		Route::resource('roles', 'RolesController');
		
		// Permissions
		Route::resource('permissions', 'PermissionsController');

		// Timelists
		Route::resource('time-lists', 'TimeListsController');

		// Assessment Groups
		Route::prefix('assessment')->group(function(){

			// Home
			Route::get('/', 'HomeController@assessments')->name('assessments');

			// Categories
			Route::resource('categories', 'AssessmentCategoryController');

			// Questionnaires
			Route::resource('questionnaires', 'QuestionnaireController');

			// Options
			Route::resource('options', 'AssessmentOptionController');

			// Choices
			Route::resource('optionChoices', 'OptionChoicesController');

		});
		
		// Packages
		Route::resource('packages', 'PackageController');

		// Package services
		Route::get('package/services/{package}', 'PackageController@services')->name('package.services');

		Route::post('package/service', 'PackageController@storeService')->name('package.service');
	});

	// FAQ's
	Route::prefix('FAQs')->group(function(){

		// Lists of all FAQ's
		Route::get('/', 'FAQController@index')->name('faqs.index');

		// Create FAQ
		Route::get('/create', 'FAQController@create')->name('faqs.create');

		// Store FAQ
		Route::post('store/faq', 'FAQController@store')->name('faqs.store');

		// Edit FAQ
		Route::get('edit/{faq}', 'FAQController@edit')->name('faqs.edit');

		// Get All Faq AJAX Request
		Route::get('get/faqs', 'FAQController@getAllFaqs');

		// Get FAQ Steps AJAX Request
		Route::get('get/faq/steps/{faq}', 'FAQController@getFaqSteps');

		// Search FAQ
		Route::get('search/faq', 'FAQController@search');
		
	});

	// Schedules
	Route::get('schedules', 'SchedulesController@index')->name('schedules.index');

	// Show Schedule
	Route::get('show-schedule', 'SchedulesController@show')->name('schedule.show');

	// Delete Schedule
	Route::post('schedule/remove/{schedule}', 'SchedulesController@removeSchedule')->name('schedule.remove');

	// Get time by date selected in calendar
	Route::get('time-by-schedule/{schedule}', 'SchedulesController@getTimeBySchedule');

	// Get onboarding questionnaires in ajax request
	Route::get('onboarding-questions', 'AssessmentCategoryController@questionnaires');

	// Get available time by date
	Route::get('time-by-date', 'SchedulesController@timeByDate');

	// Get psychologists by date and time selected
	Route::get('psychologists-by-date-time', 'SchedulesController@psychologistsByDateTime');

	// Sessions View Group
	Route::prefix('session-view')->group(function(){
		
		// Calendar
		Route::get('calendar', 'SessionViewController@calendar')->name('session.view.calendar');

	});

	// Psychologist Page
	Route::prefix('psychologist')->group(function(){

		Route::get('/', 'PsychologistsController@home')->name('psychologist.home');

		Route::get('bookings', 'PsychologistsController@bookings')->name('psychologist.bookings');

		Route::get('schedules-page', 'PsychologistsController@schedules')->name('psychologist.schedules.page');

		Route::get('schedules', 'SchedulesController@getSchedules')->name('psychologist.get.schedule');

		Route::get('progress-reports', 'ProgressReportController@index')->name('psychologist.progress.reports');

		Route::get('schedule/create', 'SchedulesController@create')->name('schedule.create');

		Route::post('update/pending/schedules', 'SchedulesController@updatePending')->name('update.pending.schedule');

		Route::post('schedule', 'SchedulesController@storeSchedule')->name('psychologist.store.schedule');

		Route::post('delete-schedule', 'SchedulesController@delete')->name('psychologist.delete.schedule');

		// create new psychologists post request
		Route::post('store', 'PsychologistsController@store')->name('psychologist.store');

		// Ajax
		Route::get('time-schedules', 'SchedulesController@timeSchedule')->name('psychologist.time.schedule');

		Route::get('available/{time}', 'SchedulesController@psychologists')->name('psychologist.available');
	});


	// Member Page
	Route::prefix('member')->group(function(){

		Route::get('/', 'MemberController@home')->name('member.home');

		Route::get('lists', 'MemberController@index')->name('member.lists');

		Route::post('member.store', 'MemberController@store')->name('member.store');

		Route::put('update/{user}', 'MemberController@update')->name('member.update');
	});

	/* Client Prefix */
	Route::prefix('client')->group(function() {

		Route::put('user/update-status/{user}', 'ClientUserController@updateStatus')->name('client.user.update.status');

		Route::get('user/delete-data/{user}', 'ClientUserController@deleteData')->name('client.user.delete.info');

		Route::get('user/create/{client}', 'ClientUserController@create')->name('client.user.create');

		Route::get('users/{client}', 'ClientUserController@index')->name('client.users.index');

		Route::post('user/store', 'ClientUserController@store')->name('client.user.store');

		Route::get('user/edit/{id}', 'ClientUserController@edit');

		Route::post('user/update/{id}', 'ClientUserController@update')->name('client.user.update');

		Route::delete('user/delete/{id}', 'ClientUserController@destroy');
	});

	/*-- Bookings --*/
	Route::prefix('bookings')->group(function(){

		/* Booking Process / Steps */
		Route::get('select-session-type', 'BookingProcessController@selectSessionType')->name('select.session.type');

		Route::get('select-client-participants', 'BookingProcessController@selectClientParticipants')->name('booking.select.client.participants');

		Route::get('onboarding', 'BookingProcessController@onboarding')->name('booking.onboarding');

		Route::get('date-and-time', 'BookingProcessController@dateAndTime')->name('booking.date.and.time');

		Route::get('review-details', 'BookingProcessController@reviewDetails')->name('booking.review.details');

		Route::get('success-page', 'BookingProcessController@successPage')->name('booking.success.page');

		Route::post('update-status/{id}', 'BookingProcessController@updateBookingStatus')->name('booking.update.status')->middleware('check-booking-status');


		/* Booking Process Actions */
		Route::get('store/client/participants', 'BookingProcessController@storeClientParticipants')->name('booking.store.client.participants');
		
		Route::get('store/session-type', 'BookingProcessController@storeSessionType')->name('booking.store.session.type');

		Route::post('store/onboarding-questions', 'BookingProcessController@storeOnboardingQuestions')->name('booking.store.onboarding.question');

		Route::post('store/date-time', 'BookingProcessController@storeDateTime')->name('booking.store.date-time');

		Route::post('confirm', 'BookingProcessController@bookingConfirm')->name('booking.confirm');


		Route::get('/', 'BookingController@index')->name('bookings.index');

		Route::get('/create', 'BookingController@create')->name('bookings.create');

		Route::get('cancel/{booking}', 'BookingController@cancel')->name('bookings.cancel');

		Route::get('reschedule/{booking}', 'BookingController@reschedule')->name('booking.reschedule');

		Route::get('session/{room_id}', 'BookingController@getAssessment')->name('booking.answered.questions');

		// Actions
		Route::post('book', 'BookingController@bookNow')->name('book.now');

		Route::post('cancel/{booking}', 'BookingController@updateToCancel')->name('cancel.booking');

		Route::post('reschedule/{booking}', 'BookingController@reschedBooking')->name('booking.reschedule.update');

		Route::put('complete/{booking}', 'BookingController@complete')->name('booking.complete');

		Route::put('no-show/{booking}', 'BookingController@noShow')->name('booking.no.show');

		Route::put('update/main/concern/{booking}', 'BookingController@updateMainConcern')->name('booking.update.main.concern');

		Route::put('add/link/to/session/{booking}', 'BookingController@addLinkToSession')->name('booking.link.to.session');

		// json
		Route::get('get-all-bookings', 'BookingController@bookingsQuery');

		Route::get('status-summary', 'BookingController@bookingStatuses');
	});

	/* Video Chat Route*/
	Route::get('video-chat/{room_id}', 'VideoChatController@index');

	Route::post('video-chat', 'VideoChatController@store')->name('video-chat.store');

	Route::get('broadcast/call/{room_id}', 'VideoChatController@broadcastCall');


	/*-- Progress Reports --*/
	Route::prefix('progress-reports')->group(function(){

		Route::get('/', 'ProgressReportController@index2')->name('progress.report');

		Route::get('create-for-booking/{booking}', 'ProgressReportController@create')->name('progress.report.create-for-booking');

		Route::get('show/{booking}', 'ProgressReportController@show')->name('progress-reports.show');

		Route::get('edit-report/{booking}', 'ProgressReportController@edit')->name('progress-reports.edit');

		Route::post('progress-report', 'ProgressReportController@store')->name('progress.report.store');

		Route::put('progress-report/{report}', 'ProgressReportController@update')->name('progress.report.update');

		Route::get('assignees', 'ProgressReportController@getAssignees')->name('progress.report.assignees');

		Route::post('assign-report/{id}', 'ProgressReportController@assignReport')->name('assign.report');

	});

});

