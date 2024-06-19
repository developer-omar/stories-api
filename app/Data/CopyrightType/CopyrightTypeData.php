<?php

namespace App\Data\CopyrightType;

use Spatie\LaravelData\Data;

class CopyrightTypeData extends Data
{
    public function __construct(
        public int $id,
        public string $copyright,
    ) {}
}
