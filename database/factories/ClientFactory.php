<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'contact_number' => $faker->tollFreePhoneNumber,
        'number_of_employees' => $faker->randomDigit,
        'postal_address' => $faker->address
    ];
});
