<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\Types\Nullable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

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
        public int $copyright_type,
        public ?int $author // ? the attribute can be int and null
    ) {}
}
