<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Education;
use Faker\Generator as Faker;

$factory->define(Education::class, function (Faker $faker) {
    return [
        'institution' => $faker->words(3, true),
        'graduate_year' => $faker->year,
        'qualification' => $faker->randomElement(Education::QUALIFICATIONS),
        'user_id' => $faker->numberBetween(1, 20)
    ];
});
