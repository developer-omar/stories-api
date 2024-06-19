<?php

namespace App\Data\AudienceType;

use Spatie\LaravelData\Data;

class AudienceTypeData extends Data
{
    public function __construct(
        public int $id,
        public string $audience,
        public string $age_range
    ) {}
}
