<?php

namespace App\Data\Story;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class StoryIndexResponseData extends Data
{
    public function __construct(
        #[DataCollectionOf(StoryData::class)]
        public DataCollection $stories
    ) {}
}
