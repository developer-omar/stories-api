<?php

namespace App\Http\Controllers\Api;

use App\Data\Category\CategoryIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Services\JsonResponseService;
use App\Services\LoggerService;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public $data;
    public function __construct(
        protected JsonResponseService $jsonResponseService,
        protected LoggerService       $logger,
        protected CategoryRepository  $categoryRepository
    ) {
        $this->data = new \stdClass();
    }

    public function index(Request $request) {
        $categories = $this->categoryRepository->getAll();
        $responseData = CategoryIndexResponseData::from([
            "categories" => $categories
        ]);
        return $this->jsonResponseService->success(200, $responseData);
    }
}
