<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UserStateData extends Data {
    public function __construct(
        public int $id,
        public string $name
    ) {
        //
    }

    /*public static function fromModel($id, $name) {
        return new self(
            $id,
            $name
        );
    }*/
}
