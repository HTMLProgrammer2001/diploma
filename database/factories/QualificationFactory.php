<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Qualification;
use Faker\Generator as Faker;

$factory->define(Qualification::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'name' => $faker->randomElement(Qualification::getQualificationNames()),
        'description' => $faker->text(),
        'user_id' => $faker->randomElement(\App\User::all()->pluck('id')->toArray())
    ];
});
