<?php


Breadcrumbs::for('options.index', function($trail){

	$trail->push('Home', route('options.index'));

});

Breadcrumbs::for('options.show', function($trail, $option){

	$trail->parent('options.index');
	$trail->push($option->name, route('options.show', $option->id));
});