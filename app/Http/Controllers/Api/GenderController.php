<?php

namespace App\Http\Controllers\Api;

use App\Data\UserGender\GenderIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\GenderRepository;
use App\Services\JsonResponseService;
use App\Services\LoggerService;

class GenderController extends Controller {
    public function __construct(
        public JsonResponseService $jsonResponseService,
        public LoggerService       $logger,
        protected GenderRepository $genderRepository,
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $genders = $this->genderRepository->getAll();
        $responseData = GenderIndexResponseData::from([
            "genders" => $genders
        ]);
        return $this->jsonResponseService->success(200, $responseData);
    }
}
