<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

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

$factory->define(\App\Character::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'class' => $faker->name,
        'level' => $faker->numberBetween(1, 60),
        'rank' => $faker->numberBetween(1, 14),
        'title' => Str::random(10),
        'profile_image' => $faker->imageUrl(),
        'user_id' => $faker->numberBetween(1, 3),
    ];
});
