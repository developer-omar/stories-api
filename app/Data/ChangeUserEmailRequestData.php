<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ChangeUserEmailRequestData extends Data
{
    public function __construct(
        public string $new_email,
        public string $password
    ) {}
}
