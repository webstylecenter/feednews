<?php

namespace Database\Factories;

use App\Models\FeedItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FeedItemFactory extends Factory
{
    protected $model = FeedItem::class;

    public function definition(): array
    {
        return [
            'feed_id' => rand(1, 2),
            'guid' => Str::random(),
            'title' => $this->faker->text(rand(10, 120)),
            'description' => $this->faker->text(250),
            'url' => $this->faker->url
        ];
    }
}
