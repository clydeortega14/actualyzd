<?php

namespace App\Http\Traits;

trait RandomClass {

	public function classes()
    {
        return [
            'badge badge-primary' => 'badge badge-primary',
            'badge badge-info' => 'badge badge-info',
            'badge badge-warning' => 'badge badge-warning',
            'badge badge-secondary' => 'badge badge-secondary',
            'badge badge-success' => 'badge badge-success',
            'badge badge-danger' => 'badge badge-danger'
        ];
    }

    public function random()
    {
    	return array_rand($this->classes());
    }
}