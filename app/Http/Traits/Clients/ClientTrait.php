<?php

namespace App\Http\Traits\Clients;

use Illuminate\Support\Facades\Validator;
use App\Client;

trait ClientTrait {


	public function validator(array $data)
	{
		return Validator::make($data, [

			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'unique:clients', 'email'],
			'contact_number' => 'required',
			'no_of_employees' => 'required',
			'address' => 'required'

		]);
	}

	public function create(array $data)
	{
		return Client::create($this->data($data));
	}

	public function data(array $data)
	{
		return [

			'name' => $data['name'],
			'email' => $data['email'],
			'contact_number' => $data['contact_number'],
			'number_of_employees' => $data['no_of_employees'],
			'postal_address' => $data['address']

		];
	}
}