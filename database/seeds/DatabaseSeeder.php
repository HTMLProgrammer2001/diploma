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
    }
}
