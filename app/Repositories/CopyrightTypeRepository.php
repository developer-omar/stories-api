<?php

namespace App\Repositories;

use App\Models\CopyrightType;
use App\Services\LoggerService;

class CopyrightTypeRepository {
    public function __construct(
        protected LoggerService $logger,
    ) {
        //
    }

    public function getAll() {
        $copyrightTypes = CopyrightType::all();
        return $copyrightTypes;
    }
}
