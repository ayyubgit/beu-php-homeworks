<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John',
            'surname' => 'Batman',
            'email' => 'johnbatman@john.batman',
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'password' => bcrypt("password"),
            'photo' => 'https://1.bp.blogspot.com/-qDe5r4YQ74M/Wlvf9rcae0I/AAAAAAABOzo/-bb4gW8LDxQvaQElwLxPAcUGC0QXDeU6gCKgBGAs/s1600/gallery_01_11.png'
        ]);

        User::factory(10)->create();
    }
}
