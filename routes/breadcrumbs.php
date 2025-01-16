<?php

// Category
Breadcrumbs::for('categories.index', function($trail){
	$trail->push('Categories', route('categories.index'));
});

// Create category
Breadcrumbs::for('categories.create', function($trail){
	$trail->parent('categories.index');
	$trail->push('Manage Category', route('categories.create'));
});

// Options Home
Breadcrumbs::for('options.index', function($trail){

	$trail->push('Home', route('options.index'));

});

// Option Show Categories
Breadcrumbs::for('options.show', function($trail, $option){

	$trail->parent('options.index');
	$trail->push($option->name, route('options.show', $option->id));
});

// Bookings
Breadcrumbs::for('bookings.create', function($trail){
	$trail->parent('home');
	$trail->push('Book a session', route('bookings.create'));
});

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// breadcrumb for selecting session type, client and participants
Breadcrumbs::for('booking.select.client.participants', function($trail){
	$trail->parent('home');
	$trail->push('select session type, client and participants', route('booking.select.client.participants'));
});

// Link to onboarding questions
Breadcrumbs::for('booking.onboarding', function($trail){
	$trail->parent('home');
	$trail->push('Onboarding Questions', route('booking.onboarding'));

});

// link to choose date, time, psychologist
Breadcrumbs::for('booking.date.and.time', function($trail){

	$trail->parent('booking.onboarding');
	$trail->push('Chose date, time and psychologist', route('booking.date.and.time'));

});

// review booking
Breadcrumbs::for('booking.review.details', function($trail){

	$trail->parent('booking.date.and.time');
	$trail->push('Review', route('booking.review.details'));
});

// Breadcrumb for success booked a session
Breadcrumbs::for('booking.success.page', function($trail){

	$trail->parent('home');
	$trail->push('Complete', route('booking.success.page'));
});

Breadcrumbs::for('booking.reschedule', function ($trail, $booking) {
	$trail->parent('home');
    $trail->push('Reschedule Booking', route('booking.reschedule', $booking));
});

// Psychologist booking breadcrumbs
Breadcrumbs::for('psychologist.bookings', function($trail){
	$trail->parent('home');
	$trail->push('Bookings', route('psychologist.bookings'));
});

Breadcrumbs::for('progress.report', function($trail){
	$trail->parent('home');
	$trail->push('Progress Reports', route('progress.report'));
});

Breadcrumbs::for('progress.report.create-for-booking', function($trail, $booking){
	$trail->parent('progress.report', route('progress.report'));
	$trail->push('View report', route('progress.report.create-for-booking', $booking));
});

Breadcrumbs::for('progress-reports.edit', function($trail, $booking){
	$trail->parent('progress.report', route('progress.report'));
	$trail->push('Progress Report', route('progress-reports.edit', $booking));
});

// Reason for canceling
Breadcrumbs::for('bookings.cancel', function($trail, $booking){

	$trail->parent('home', route('home'));
	$trail->push('Booking canceling', route('bookings.cancel', $booking));
});


/* -- Frequently Ask Questions Breadcrumbs -- */

// FAQs Index
Breadcrumbs::for('faqs.index', function($trail){

	$trail->push('Lists', route('faqs.index'));

});

// FAQs Create
Breadcrumbs::for('faqs.create', function($trail){

	$trail->parent('faqs.index', route('faqs.index'));
	$trail->push('FAQ Create', route('faqs.create'));

});


Breadcrumbs::for('faqs.edit', function ($trail, $faq) {

	$trail->parent('faqs.index', route('faqs.index'));
    $trail->push('Edit', route('faqs.edit', $faq));
});

// BILLINGS Breadcrumbs
Breadcrumbs::for('client.billings', function($trail, $client){
	$trail->push('Home', route('client.billings', $client));
});

// Billings Details


