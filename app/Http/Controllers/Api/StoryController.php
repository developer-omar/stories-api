<?php

namespace App\Http\Controllers\Api;

use App\Data\StoryIndexResponseData;
use App\Data\StoryRequestData;
use App\Enums\ImageTypeEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Repositories\StoryReporsitory;
use App\Services\ApiResponseService;
use App\Services\LoggerService;
use App\Services\ImageManageService;
use Illuminate\Http\Request;

class StoryController extends Controller {

    public function __construct(
        public ApiResponseService $apiResponse,
        public LoggerService      $logger,
        public StoryReporsitory   $storyReporsitory,
    ) {
        //
    }


    public function indexByUserId(Request $request) {
        try {
            $userId = $request->route("id");
            $stories = $this->storyReporsitory->getAllByUser($userId, UserStatusEnum::NOT_LOGGED_IN);
            if (is_null($stories))
                return $this->apiResponse->responseHttp404();
            $responseData = StoryIndexResponseData::from([
                'stories' => $stories->toArray()
            ]);
            return $this->apiResponse->responseHttp200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp500();
        }
    }

    public function indexByCategoryId(Request $request) {
        try {
            $categoryId = $request->route("id");
            $stories = $this->storyReporsitory->getAllByCategory($categoryId);
            if (is_null($stories))
                return $this->apiResponse->responseHttp404();
            $responseData = StoryIndexResponseData::from([
                'stories' => $stories->toArray()
            ]);
            return $this->apiResponse->responseHttp200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp500();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoryRequest $request, ImageManageService $imageManageService) {
        $requestData = StoryRequestData::from($request);
        $user = auth()->user();
        //manage of image file
        try {
            $imageName = $imageManageService->store($requestData->cover_image, ImageTypeEnum::STORY);
            if(is_null($imageName))
                return $this->apiResponse->responseHttp422();
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp500();
        }
        //manage of store in database
        try {
            $story = $this->storyReporsitory->save($requestData, $imageName, $user->id);
            return $story;
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp422();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        try {

        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->responseHttp500();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
