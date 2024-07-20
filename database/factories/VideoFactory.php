<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\Video::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'path' => 'videos/test-video.mp4',
            'thumbnail' => 'thumbnails/test-video.jpg',
            'created_at' => now()->subMonths(10),
            'updated_at' => now()->subMonths(10),
            'category_id' => Category::factory(),
        ];
    }
}
