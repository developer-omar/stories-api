<?php

namespace App\Data\Story;

use Spatie\LaravelData\Data;

class UpdateStoryResponseData extends Data
{
    public function __construct(
        public StoryData $story
    ) {}
}
