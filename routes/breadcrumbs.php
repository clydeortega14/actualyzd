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
	$trail->parent('member.home');
	$trail->push('Book a session', route('bookings.create'));
});

// Member
Breadcrumbs::for('member.home', function ($trail) {
    $trail->push('Home', route('member.home'));
});