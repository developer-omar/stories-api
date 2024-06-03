<?php

namespace App\Http\Controllers\Api;

use App\Data\GenderIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\GenderRepository;
use App\Services\ApiResponseService;
use App\Services\LoggerService;
use Illuminate\Http\Request;

class GenderController extends Controller {
    public function __construct(
        public ApiResponseService  $apiResponse,
        public LoggerService       $logger,
        protected GenderRepository $genderRepository,
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $genders = $this->genderRepository->getAll();
            $responseData = GenderIndexResponseData::from($genders);
            return $this->apiResponse->responseHttp200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp500();
        }
    }
}
