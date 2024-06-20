<?php

namespace App\Http\Controllers\Api;

use App\Data\CopyrightType\CopyrightTypeIndexResponseData;
use App\Http\Controllers\Controller;
use App\Repositories\CopyrightTypeRepository;
use App\Services\JsonResponseService;
use App\Services\LoggerService;

class CopyrightTypeController extends Controller {
    public function __construct(
        public JsonResponseService        $jsonResponseService,
        public LoggerService              $logger,
        protected CopyrightTypeRepository $copyrightTypeRepository,
    ) {
        //
    }

    public function index() {
        try {
            $copyrightTypes = $this->copyrightTypeRepository->getAll();
            $responseData = CopyrightTypeIndexResponseData::from([
                "copyright_types" => $copyrightTypes->toArray()
            ]);
            return $this->jsonResponseService->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }
}
