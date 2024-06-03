<?php

namespace App\Repositories;

use App\Models\UserGender;
use App\Services\LoggerService;

class GenderRepository {
    public function __construct(
        protected LoggerService $logger,
    ) {
        //
    }

    public function getAll() {
        $genders = UserGender::all();
        return $genders;
    }
}
