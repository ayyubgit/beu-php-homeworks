<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title, '-');

        $pictures = [
            'https://vignette.wikia.nocookie.net/happytreefriends/images/0/08/HTF_characters-1-.png/revision/latest/smart/width/400/height/225?cb=20180121131037',
            'https://png.vector.me/files/images/1/8/183627/happy_tree_friends_cartoon_characters_vector_material.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYvuUbANk2rR46Np4TzhvLQVWr6-jssmAxkw&usqp=CAU',
            'https://cdn.episode.ninja/file/episodeninja/4732459.jpg',
            'https://i.ytimg.com/sh/gzbWUln8uUsdu3yYdnrBGg/market.jpg'
        ];
        return [
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->paragraphs(5, true),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'thumbnail' => $pictures[rand(0, 4)],
        ];
    }
}
