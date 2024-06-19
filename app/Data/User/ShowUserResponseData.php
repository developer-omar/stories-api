<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;

class ShowUserResponseData extends Data
{
    public function __construct(
        public UserData $user,
    ) {}
}
