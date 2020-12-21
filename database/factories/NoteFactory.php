<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'user_id' => rand(1, 10),
            'name' => $this->faker->text(rand(10, 120)),
            'content' => $this->faker->realText(500),
            'position' => 0
        ];
    }
}
