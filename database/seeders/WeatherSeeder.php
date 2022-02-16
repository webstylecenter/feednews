<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    public function run(): void
    {
        Weather::factory()->create([
            'location' => 'Eindhoven,NL',
        ]);

        Weather::factory()->create([
            'location' => 'Amsterdam,NL',
        ]);

        Weather::factory()->create([
            'location' => 'London,UK',
        ]);

        Weather::factory()->create([
            'location' => 'Boston,USA',
        ]);
    }
}
