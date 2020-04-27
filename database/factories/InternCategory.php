<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InternCategory;
use Faker\Generator as Faker;

$factory->define(InternCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word()
    ];
});
