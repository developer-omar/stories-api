<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $storyId = 1;
        for ($i = 0; $i < 50; $i++) {
            if ($i > 0 && $i%5 == 0)
                $storyId++;
            Chapter::create([
                'title' => 'capitulo de prueba ' . ($i + 1),
                'content' => 'contenido de prueba ' . ($i + 1),
                'publication_state' => 1,
                'story_id' => $storyId,
                'deleted_state' => 0,
            ]);

        }
    }
}
