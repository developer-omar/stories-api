<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;

class StoreUserResponseData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $last_name,
        public string $birth_date,
        public string $email,
        public string $username,
        public string $created_at,
    ) {}
}
