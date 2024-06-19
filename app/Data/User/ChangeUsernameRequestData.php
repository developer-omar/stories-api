<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;

class ChangeUsernameRequestData extends Data
{
    public function __construct(
        public string $new_username,
        public string $password
    ) {}
}
