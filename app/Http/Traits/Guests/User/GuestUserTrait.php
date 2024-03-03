<?php

namespace App\Http\Traits\Guests\User;

use App\Http\Requests\GuestUserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;


trait GuestUserTrait {

	use RegistersUsers;

	public function storeApplyingIndividual(GuestUserRequest $request)
	{
		$user = $this->createUser($request->all());

		$user->roles()->attach(4);

		event(new Registered($user));

		$this->guard()->login($user);

		return redirect()->route('home');
	}

	public function createUser(array $data)
	{
		return User::firstOrCreate([
			'name' => $data['name'],
			'email' => $data['email'],
			'username' => $data['email'],
			'password' => Hash::make($data['password'])
		]);
	}
}