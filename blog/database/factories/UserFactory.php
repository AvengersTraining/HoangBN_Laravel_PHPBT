<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'display_name' => $faker->name,
        'birthday' => $faker->date(),
        'phone_number' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->md5('123456789'),
        'avatar' => $faker->imageUrl(),
        'remember_token' => Str::random(10),
    ];
});
