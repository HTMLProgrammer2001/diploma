<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Department::class, 3)->create();
        factory(\App\Commission::class, 3)->create();
        factory(\App\User::class, 5)->create();
        factory(\App\Honor::class, 10)->create();
        factory(\App\InternCategory::class, 3)->create();
        factory(\App\Place::class, 5)->create();
        factory(\App\Internship::class, 30)->create();
        factory(\App\Publication::class, 25)->create();
        factory(\App\Qualification::class, 7)->create();
        factory(\App\Rebuke::class, 10)->create();
    }
}
