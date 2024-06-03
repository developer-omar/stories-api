<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UpdateUserResponseData extends Data
{
    public function __construct(
        public UserData $user,
    ) {}
}
