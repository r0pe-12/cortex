<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'user_id'=>User::factory(),
            'title'=>$this->faker->text(60),
//            'slug'=>$this->faker->slug,
            'short_description'=>$this->faker->text(100),
            'content'=>$this->faker->text,
            'picture'=>$this->faker->imageUrl(900, 300),
        ];
    }
}
