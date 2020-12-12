<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $pictures = [
            'https://1.bp.blogspot.com/-qDe5r4YQ74M/Wlvf9rcae0I/AAAAAAABOzo/-bb4gW8LDxQvaQElwLxPAcUGC0QXDeU6gCKgBGAs/s1600/gallery_01_11.png',
            'https://3.bp.blogspot.com/-_ye23HGuhWc/Wlvf9oSaYxI/AAAAAAABOzo/8n42T6m1bZkJBAFEAlpDnbrKpzIauIGhwCKgBGAs/s1600/cuddles_profile_picture.png',
            'https://3.bp.blogspot.com/-kVqi2kYDbgM/Wlvf9mjKFXI/AAAAAAABOzo/wHOdH39GG4gL7wYxKU-tGtJfp-08F3w7gCKgBGAs/s1600/giggles_profile.png',
            'https://1.bp.blogspot.com/-TeamNEFB5sM/Wlvf9n_AmXI/AAAAAAABOzo/nLuwaga_4xMu6gkYXW5ebSF4ukV3jt7VQCKgBGAs/s1600/toothys_profile.png',
            'https://3.bp.blogspot.com/-DpUqlWGhMtA/Wlvf9utf2fI/AAAAAAABOzo/L2tMoDRke6kkcjmnhP52Jm1WiS7ChZWEQCKgBGAs/s1600/sniffles_profile.png'
        ];
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'user',
            'photo' => $pictures[rand(0, 4)]
        ];
    }
}
