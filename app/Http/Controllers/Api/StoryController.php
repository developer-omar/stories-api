<?php

namespace App\Http\Controllers\Api;

use App\Data\Story\StoreStoryResponseData;
use App\Data\Story\StoryIndexResponseData;
use App\Data\Story\StoryRequestData;
use App\Enums\ImageTypeEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Repositories\StoryReporsitory;
use App\Services\JsonResponseService;
use App\Services\ImageManageService;
use App\Services\LoggerService;
use Illuminate\Http\Request;

class StoryController extends Controller {

    public function __construct(
        public JsonResponseService $jsonResponseService,
        public LoggerService       $logger,
        public StoryReporsitory    $storyReporsitory,
    ) {
        //
    }


    public function indexByUserId(Request $request) {
        try {
            $userId = $request->route("id");
            $stories = $this->storyReporsitory->getAllByUser($userId, UserStatusEnum::NOT_LOGGED_IN);
            if (is_null($stories))
                return $this->jsonResponseService->http404();
            $responseData = StoryIndexResponseData::from([
                'stories' => $stories->toArray()
            ]);
            return $this->jsonResponseService->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }

    public function indexByCategoryId(Request $request) {
        try {
            $categoryId = $request->route("id");
            $stories = $this->storyReporsitory->getAllByCategory($categoryId);
            if (is_null($stories))
                return $this->jsonResponseService->http404();
            $responseData = StoryIndexResponseData::from([
                'stories' => $stories->toArray()
            ]);
            return $this->jsonResponseService->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoryRequest $request, ImageManageService $imageManageService) {
        $requestData = StoryRequestData::from($request);
        $user = auth()->user();
        //managing of image file
        try {
            $imageName = $imageManageService->store($requestData->cover_image, ImageTypeEnum::STORY);
            if(is_null($imageName))
                return $this->jsonResponseService->http422();
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
        //managing of store in database
        try {
            $story = $this->storyReporsitory->save($requestData, $imageName, $user->id);
            $responseData = StoreStoryResponseData::from([
                "story" => $story
            ]);
            return $this->jsonResponseService->http200($responseData);
            //return $story;
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http422();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        try {

        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
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
