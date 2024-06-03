<?php

namespace App\Http\Controllers\Api;

use App\Data\CopyrightTypesIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\CopyrightTypeRepository;
use App\Services\ApiResponseService;
use App\Services\LoggerService;
use Illuminate\Http\Request;

class CopyrightTypeController extends Controller {
    public function __construct(
        public ApiResponseService         $apiResponse,
        public LoggerService              $logger,
        protected CopyrightTypeRepository $copyrightTypeRepository,
    ) {
        //
    }

    public function index() {
        try {
            $copyrightTypes = $this->copyrightTypeRepository->getAll();
            $responseData = CopyrightTypesIndexResponseData::from([
                "copyright_types" => $copyrightTypes->toArray()
            ]);
            return $this->apiResponse->responseHttp200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp500();
        }
    }
}
