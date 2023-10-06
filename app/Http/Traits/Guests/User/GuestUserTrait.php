<?php

namespace App\Http\Traits\Guests\User;

use App\Http\Requests\GuestUserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


trait GuestUserTrait {


	public function storeApplyingIndividual(GuestUserRequest $request)
	{
		$user = $this->createUser($request->all());

		$user->roles()->attach(4);

		event(new Registered($user));


		return redirect()->back()->with('success', 'Successfully Registered');
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