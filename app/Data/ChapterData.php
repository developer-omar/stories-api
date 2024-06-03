<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ChapterData extends Data {
    public function __construct(
        public int $id,
        public string $title,
        public string|Optional $content,
        public int $publication_state,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d H:i")]
        public \DateTime $created_at,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d H:i")]
        public \DateTime $updated_at,
    ) {}
}
