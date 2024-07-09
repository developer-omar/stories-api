<?php

namespace App\Http\Controllers\Api;

use App\Data\AudienceType\AudienceTypeIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\AudienceTypeRepository;
use App\Services\JsonResponseService;
use App\Services\LoggerService;

class AudienceTypeController extends Controller {
    public function __construct(
        public JsonResponseService       $jsonResponseService,
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
            return $this->jsonResponseService->success(200, $responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }
}
