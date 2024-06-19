<?php

namespace App\Data\User;

use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class UpdateUserRequestData extends Data
{
    public function __construct(
        public string|null $photo,
        public string $name,
        public string $last_name,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public \DateTime $birth_date,
        public string $about_you,
        public string $location,
        public int $gender,
    ) {}
}
