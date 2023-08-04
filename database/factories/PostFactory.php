<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->paragraph(10),
            'user_id' => User::factory()->create(),
        ];
    }
}
