<?php

namespace App\Data\Story;

use Spatie\LaravelData\Data;

class StoreStoryResponseData extends Data
{
    public function __construct(
        public StoryData $story
    ) {}
}
