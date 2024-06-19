<?php

namespace App\Data\AudienceType;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class AudienceTypeIndexResponseData extends Data
{
    public function __construct(
        #[DataCollectionOf(AudienceTypeData::class)]
        public DataCollection $audience_types
    ) {}
}
