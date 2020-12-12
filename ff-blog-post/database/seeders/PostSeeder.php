<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Faker\Provider\Address;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(10)->create();


        Post::all()->each(function ($post) {

            $randomCount = rand(1, 3);
            while ($randomCount--)
                $comment = $post->comments()->create([
                    'user_id' => User::all()->random()->id,
                    'comment' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
                ]);

            $randomCount = rand(1, 3);
            while ($randomCount--)
                $post->comments()->create([
                    'user_id' => User::all()->random()->id,
                    'comment' => 'This is Reply when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'comment_id' => $comment->id
                ]);
        });
    }
}
