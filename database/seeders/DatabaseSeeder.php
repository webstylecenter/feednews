<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(FeedSeeder::class);
        $this->call(UserFeedSeeder::class);
        $this->call(NoteSeeder::class);
    }
}
