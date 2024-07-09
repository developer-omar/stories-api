<?php

namespace App\Data\Story;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

// A DTO for save and update a story
class StoryRequestData extends Data
{
    public function __construct(
        public UploadedFile|Optional $cover_image,
        public string $title,
        public string $description,
        public string $tags,
        public int $rating,
        public int $story_status,
        public int $category,
        public int $audience_type,
        public int $copyright_type
    ) {}
}
