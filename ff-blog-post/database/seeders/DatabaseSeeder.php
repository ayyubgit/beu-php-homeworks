<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Artisan::call('migrate:fresh');
        Artisan::call('key:generate');
        Artisan::call('storage:link');

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class
        ]);
    }
}
