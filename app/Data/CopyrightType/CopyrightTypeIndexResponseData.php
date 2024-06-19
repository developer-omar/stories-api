<?php

namespace App\Data\CopyrightType;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CopyrightTypeIndexResponseData extends Data
{
    public function __construct(
        #[DataCollectionOf(CopyrightTypeData::class)]
        public DataCollection $copyright_types
    ) {}
}
