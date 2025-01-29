<?php

namespace App\Http\Traits;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

trait handleUsersTraits {

    public function validateUserData($request)
    {
        return Validator::make($request->all(), [

            'role_name' => ['required', 'string', 'max:50'],
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:users', 'max:50'],
            'password' => ['required', 'confirmed', 'min:8'],
            'resume.*' => ['required', 'mimes:jpg,jpeg,png,pdf,docx', 'max:2048']
        ]);
    }

    public function createUserData($request)
    {
        return User::create([
            'name' => $request->firstname.' '.$request->lastname,
            'email' => $request->email,
            'username'=> $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
    
}