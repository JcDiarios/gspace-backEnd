<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;//for random user_id
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gspace>
 */
class GspaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => fake()->randomElement(User::pluck("id")),
            "date" => fake()->dateTime(),
            "time" => fake()->time(),
            "room" => fake()->randomElement(["console", "pcgaming", "arcade"])
        ];
    }
}
