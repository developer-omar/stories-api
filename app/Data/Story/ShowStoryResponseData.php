<?php

namespace App\Data\Story;

use Spatie\LaravelData\Data;

class ShowStoryResponseData extends Data
{
    public function __construct(
        public StoryData $story
    ) {}
}
