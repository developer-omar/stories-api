<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class StoreUserRequestData extends Data {
    public function __construct(
        public string $name,
        public string $last_name,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public \DateTime $birth_date,
        public string $email,
        public string $username,
        public string $password,
   ) {
        //
    }
}
