<?php

namespace App\Http\Controllers\Api;

use App\Data\Story\ShowStoryResponseData;
use App\Data\Story\StoreStoryResponseData;
use App\Data\Story\StoryIndexResponseData;
use App\Data\Story\StoryRequestData;
use App\Data\Story\UpdateStoryResponseData;
use App\Enums\ImageTypeEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Repositories\StoryReporsitory;
use App\Services\JsonResponseService;
use App\Services\ImageManageService;
use App\Services\LoggerService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StoryController extends Controller {

    public function __construct(
        public JsonResponseService $jsonResponseService,
        public LoggerService       $logger,
        public StoryReporsitory    $storyReporsitory,
    ) {
        //
    }

    public function index(Request $request) {
        try {
            $user = auth()->user();
            $stories = $this->storyReporsitory->getAllByUser($user->id, UserStatusEnum::LOGGED_IN);
            $responseData = StoryIndexResponseData::from([
                'stories' => $stories->toArray()
            ]);
            return $this->jsonResponseService->success(200, $responseData);
        } catch(\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->error(500);
        }
    }


    public function indexByUserId(Request $request) {
        try {
            $userId = $request->route("userId");
            $stories = $this->storyReporsitory->getAllByUser($userId, UserStatusEnum::NOT_LOGGED_IN);
            if (is_null($stories))
                return $this->jsonResponseService->fail(404);
            $responseData = StoryIndexResponseData::from([
                'stories' => $stories->toArray()
            ]);
            return $this->jsonResponseService->success(200, $responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->error(500);
        }
    }

    public function indexByCategoryId(Request $request) {
        try {
            $categoryId = $request->route("categoryId");
            $stories = $this->storyReporsitory->getAllByCategory($categoryId);
            if (is_null($stories))
                return $this->jsonResponseService->fail(404);
            $responseData = StoryIndexResponseData::from([
                'stories' => $stories->toArray()
            ]);
            return $this->jsonResponseService->success(200, $responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->error(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoryRequest $request) {
        $requestData = StoryRequestData::from($request);
        $user = auth()->user();
        try {
            $story = $this->storyReporsitory->save($requestData, $user->id);
            if($story == false)
                return $this->jsonResponseService->http422();
            $responseData = StoreStoryResponseData::from([
                "story" => $story
            ]);
            return $this->jsonResponseService->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) {
        try {
            $id = (int)$request->route("id");
            $story = $this->storyReporsitory->getById($id);
            if(is_null($story))
                return $this->jsonResponseService->fail(404);
            $responseData = ShowStoryResponseData::from([
                "story" => $story
            ]);
            return $this->jsonResponseService->success(200, $responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->error(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoryRequest $request, ImageManageService $imageManageService) {
        try {
            $id = (int)$request->route("id");
            $user = auth()->user();
            $requestData = StoryRequestData::from($request);
            $story = $this->storyReporsitory->update($requestData, $id, $user->id);
            if(is_null($story))
                return $this->jsonResponseService->http404();
            elseif ($story === false)
                return $this->jsonResponseService->http403();
            $responseData = UpdateStoryResponseData::from([
                "story" => $story
            ]);
            return $this->jsonResponseService->http200($responseData);
        } catch(\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $id = (int)$request->route("id");
            $user = auth()->user();
            $result = $this->storyReporsitory->delete($id, $user->id);
            if(is_null($result))
                return $this->jsonResponseService->http404();
            elseif ($result === false)
                return $this->jsonResponseService->http403();

            return $this->jsonResponseService->http200();
        } catch(\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }
}
