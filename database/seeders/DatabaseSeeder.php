<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AudienceType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserStateSeeder::class,
            UserGenderSeeder::class,
            CategorySeeder::class,
            CopyrightTypeSeeder::class,
            AudienceTypeSeeder::class,
            UserSeeder::class,
//            StorySeeder::class,
//            ChapterSeeder::class,
        ]);
    }
}
