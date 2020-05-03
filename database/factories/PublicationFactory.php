<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Publication;
use Faker\Generator as Faker;

$factory->define(Publication::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
        'description' => $faker->text(),
        'date_of_publication' => $faker->date(),
        'another_authors' => $faker->name,
        'publisher' => $faker->company,
        'url' => $faker->url
    ];
});
