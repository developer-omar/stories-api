<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class UserLoginRequestData extends Data {
    public function __construct(
        public readonly string $email_username,
        public readonly string $password,
    ) {}
}
