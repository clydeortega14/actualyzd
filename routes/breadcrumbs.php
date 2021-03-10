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


Breadcrumbs::for('options.index', function($trail){

	$trail->push('Home', route('options.index'));

});

Breadcrumbs::for('options.show', function($trail, $option){

	$trail->parent('options.index');
	$trail->push($option->name, route('options.show', $option->id));
});