<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CopyrightTypesIndexResponseData extends Data
{
    public function __construct(
        #[DataCollectionOf(CopyrightTypeData::class)]
        public DataCollection $copyright_types
    ) {}
}
