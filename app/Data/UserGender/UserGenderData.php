<?php

namespace App\Data\UserGender;

use Spatie\LaravelData\Data;

class UserGenderData extends Data {
    public function __construct(
        public int $id,
        public string $name,
    ) {
        //
    }

    /*public static function fromModel(int $id, string $name) {
        return new self(
            $id,
            $name,
        );
    }*/
}
