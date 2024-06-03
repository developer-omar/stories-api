<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 0; $i < 10; $i++) {
            if($i < 3)
                $categoryId = 1;
            elseif ($i < 6)
                $categoryId = 2;
            else
                $categoryId = 3;
            Story::create([
                'cover_image' => null,
                'title' => 'titulo de prueba ' . ($i +1),
                'description' => 'description de prueba ' . ($i + 1),
                'tags' => 'tag1,tag2,tag3,tag4,tag5',
                'rating' => 1,
                'story_status' => 1,
                'category_id' => $categoryId,
                'audience_type_id' => 1,
                'copyright_type_id' => 1,
                'user_id' => 1,
                'deleted_state' => 0,
            ]);
        }
    }
}
