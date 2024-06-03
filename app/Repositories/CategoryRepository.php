<?php

namespace App\Repositories;

use App\Models\Category;
use App\Services\LoggerService;

class CategoryRepository {

    public function __construct(
        protected LoggerService $logger,
    ) {
        //
    }

    public function getAll() {
        $categories = Category::select();
        return $categories->get();
    }

}
