<?php

namespace App\Http\Controllers\Api;

use App\Data\CategoryIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Services\ApiResponseService;
use App\Services\LoggerService;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public $data;
    public function __construct(
        protected ApiResponseService $apiResponse,
        protected LoggerService      $logger,
        protected CategoryRepository $categoryRepository
    ) {
        $this->data = new \stdClass();
    }

    public function index(Request $request) {
        $categories = $this->categoryRepository->getAll();
        $response = CategoryIndexResponseData::from($categories);
        return $this->apiResponse->responseHttp200($response);
    }
}
