<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' =>  str_random(20), // secret
        'remember_token' => str_random(12),
        'city' => $faker->city,
        'street' => $faker->streetName,
        'postcode' => $faker->postcode,
        'country' => $faker->country,
        'latitude' => $faker->longitude,
        'longitude' => $faker->latitude,
        'phoneNumber' => $faker->phoneNumber,
        'company' => $faker->company,
        'jobTitle' => $faker->jobTitle,
        'locale' => $faker->locale,

    ];
});
