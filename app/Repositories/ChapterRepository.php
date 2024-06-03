<?php

namespace App\Repositories;

use App\Services\LoggerService;

class ChapterRepository {
    public function __construct(
        protected LoggerService $logger,
    ) {
        //
    }
}
