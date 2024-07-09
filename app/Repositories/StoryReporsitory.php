<?php

namespace App\Repositories;

use App\Data\Story\StoryRequestData;
use App\Enums\DeletedStateEnum;
use App\Enums\ImageTypeEnum;
use App\Enums\PublicationStatusEnum;
use App\Enums\UserStatusEnum;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Story;
use App\Models\User;
use App\Services\ImageManageService;
use App\Services\LoggerService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StoryReporsitory {
    public function __construct(
        protected LoggerService $logger,
        protected ImageManageService $imageManageService,
    ) {
        //
    }

    public function getAllByUser($userId, UserStatusEnum $userStatus) {
        $user = User::select()
            ->where("id", $userId)
            ->where("user_state_id", "!=", 2) // any state differente to deleted
            ->first();
        if (is_null($user))
            return null;
        $stories = $this->getAll($user->stories(), $userStatus);
        return $stories;
    }

    public function getAllByCategory($categoryId) {
        $category = Category::find($categoryId);
        if (is_null($category))
            return null;
        $stories = $this->getAll($category->stories(), UserStatusEnum::NOT_LOGGED_IN);
        return $stories;
    }

    private function getAll(HasMany $query, UserStatusEnum $userStatus) {
        /*if ($userStatus->value)
            $publicationStatus = PublicationStatusEnum::PUBLISHED;*/
        $stories = $query->where('deleted_state', DeletedStateEnum::NOT_DELETED->value)
            ->orderBy('created_at', 'desc')
            ->withCount([
                'chapters' => function(Builder $query) use ($userStatus) {
                    $query->where('deleted_state', DeletedStateEnum::NOT_DELETED->value);
                    if (!$userStatus->value)
                        $query->where('publication_status', PublicationStatusEnum::PUBLISHED->value);
                }
            ])
            ->with([
                "category" => function($query) {
                    $query->select('id', 'name', 'slug');
                },
                'audienceType' => function($query) {
                    $query->select('id', 'audience', 'age_range');
                },
                "copyrightType" => function($query) {
                    $query->select("id", "copyright");
                },
                "user" => function($query) {
                    $query->select("id", "username", "name", "last_name");
                },
                //"chapter"
            ]);
        return $stories->get();
    }

    public function getById(int $id) {
        $story = Story::where('deleted_state', DeletedStateEnum::NOT_DELETED->value)
            ->with([
                "category" => function($query) {
                    $query->select('id', 'name', 'slug');
                },
                'audienceType' => function($query) {
                    $query->select('id', 'audience', 'age_range');
                },
                "copyrightType" => function($query) {
                    $query->select("id", "copyright");
                },
                "user" => function($query) {
                    $query->select("id", "username", "name", "last_name");
                },
            ])
            ->withCount([
                'chapters' => function(Builder $query) /*use ($userStatus)*/ {
                    $query->where('deleted_state', DeletedStateEnum::NOT_DELETED->value);
                    /*if (!$userStatus->value)
                        $query->where('publication_status', PublicationStatusEnum::PUBLISHED->value);*/
                }
            ])
            ->find($id);
        return $story;
    }

    public function save(StoryRequestData $storyRequestData, int $userId) {
        // managing of image file
        $coverImage = $this->imageManageService->store($storyRequestData->cover_image, ImageTypeEnum::STORY);

        // managing of store
        $story = Story::create([
            "cover_image" => $coverImage,
            "title" => $storyRequestData->title,
            "slug" => null,
            "description" => $storyRequestData->description,
            "tags" => $storyRequestData->tags,
            "rating" => $storyRequestData->rating,
            "story_status" => $storyRequestData->story_status,
            "category_id" => $storyRequestData->category,
            "audience_type_id" => $storyRequestData->audience_type,
            "copyright_type_id" => $storyRequestData->copyright_type,
            "user_id" => $userId
        ]);
        $story = $this->getById($story->id);
        return $story;
    }

    public function update(StoryRequestData $storyRequestData, int $id, int $userId) {
        $story = Story::select()
            ->where("id", $id)
            ->where("deleted_state", DeletedStateEnum::NOT_DELETED->value)
            ->first();
        if(is_null($story))
            return null;
        if($story->user_id !== $userId)
            return false;

        $coverImageArray = explode("/", $story->cover_image);
        $coverImage = end($coverImageArray);
        if($storyRequestData->cover_image instanceof UploadedFile) {
            // deleting the current cover image
            $this->imageManageService->delete($coverImage, ImageTypeEnum::STORY);

            // storing the new cover image
            $coverImage = $this->imageManageService->store($storyRequestData->cover_image, ImageTypeEnum::STORY);
        }
        $story->cover_image = $coverImage;
        $story->title = $storyRequestData->title;
        $story->slug = null;
        $story->description = $storyRequestData->description;
        $story->tags = $storyRequestData->tags;
        $story->rating = $storyRequestData->rating;
        $story->story_status = $storyRequestData->story_status;
        $story->category_id = $storyRequestData->category;
        $story->audience_type_id = $storyRequestData->audience_type;
        $story->copyright_type_id = $storyRequestData->copyright_type;
        $story->user_id = $userId;
        $story->save();
        return $this->getById($id);
    }

    public function delete(int $id, int $userId) {
        $story = Story::select()
            ->where("id", $id)
            ->where("deleted_state", DeletedStateEnum::NOT_DELETED->value)
            ->first();
        if(is_null($story))
            return null;
        if($story->user_id !== $userId)
            return false;

        //deleting story
        $story->deleted_state = 1;
        $story->save();

        // deleting chapters that become to the story
        Chapter::where("story_id", $id)
            ->update([
                "deleted_state" => 1
            ]);
        return true;
    }
}
