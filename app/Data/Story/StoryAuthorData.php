<?php

namespace App\Data\Story;

use Spatie\LaravelData\Data;

class StoryAuthorData extends Data
{
    public function __construct(
        public int $id,
        public string $username,
        public string $name,
        public string $last_name,
    ) {}
}
