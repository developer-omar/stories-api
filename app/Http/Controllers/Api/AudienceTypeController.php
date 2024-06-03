<?php

namespace App\Http\Controllers\Api;

use App\Data\AudienceTypeData;
use App\Data\AudienceTypeIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\AudienceTypeRepository;
use App\Services\ApiResponseService;
use App\Services\LoggerService;
use Illuminate\Http\Request;

class AudienceTypeController extends Controller {
    public function __construct(
        public ApiResponseService        $apiResponse,
        public LoggerService             $logger,
        protected AudienceTypeRepository $audienceTypeRepository,
    ) {
        //
    }

    public function index() {
        try {
            $audienceTypes = $this->audienceTypeRepository->getAll();
            $responseData = AudienceTypeIndexResponseData::from([
                "audience_types" => $audienceTypes->toArray()
            ]);
            return $this->apiResponse->responseHttp200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp500();
        }
    }
}
