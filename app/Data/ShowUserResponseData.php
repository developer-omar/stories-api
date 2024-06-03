<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ShowUserResponseData extends Data
{
    public function __construct(
        public UserData $user,
    ) {}
}
