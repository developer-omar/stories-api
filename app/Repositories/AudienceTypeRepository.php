<?php

namespace App\Repositories;

use App\Models\AudienceType;
use App\Services\LoggerService;

class AudienceTypeRepository {
    public function __construct(
        protected LoggerService $logger,
    ) {
        //
    }

    public function getAll() {
        $audienceTypes = AudienceType::all();
        return $audienceTypes;
    }
}
