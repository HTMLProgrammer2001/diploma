<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Honor;
use Faker\Generator as Faker;

$factory->define(Honor::class, function (Faker $faker) {
    return [
        'order' => $faker->numberBetween(1000000),
        'date_presentation' => $faker->date(),
        'title' => $faker->words(3, true),
        'active' => $faker->boolean(75),
        'user_id' => $faker->randomElement(\App\User::all()->pluck('id')->toArray())
    ];
});
