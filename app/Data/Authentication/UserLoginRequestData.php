<?php

namespace App\Data\Authentication;

use Spatie\LaravelData\Data;

class UserLoginRequestData extends Data {
    public function __construct(
        public readonly string $email_username,
        public readonly string $password,
    ) {}
}
