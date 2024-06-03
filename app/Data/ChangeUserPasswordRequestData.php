<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ChangeUserPasswordRequestData extends Data
{
    public function __construct(
        public string $current_password,
        public string $new_password
    ) {}
}
