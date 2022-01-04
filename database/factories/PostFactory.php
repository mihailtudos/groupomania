<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'excerpt' => $this->faker->sentence(20),
            'likes' => json_encode([1, 2, 4]),
            'dislikes' => json_encode([3]),
            'user_id' => 1,
        ];
    }
}
