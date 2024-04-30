<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topic = Topic::first() ?? Topic::factory()->create();
        return [
            'topic_id' => $topic->id,
            'thumbnail' => fake()->url(),
            'banner' => fake()->url(),
            'content' => fake()->sentence(),
            'author' => fake()->firstName(),
        ];
    }
}
