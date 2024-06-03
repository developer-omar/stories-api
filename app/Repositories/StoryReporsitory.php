<?php

namespace App\Repositories;

use App\Data\StoryRequestData;
use App\Enums\DeletedStateEnum;
use App\Enums\PublicationStatusEnum;
use App\Enums\UserStatusEnum;
use App\Models\Category;
use App\Models\Story;
use App\Models\User;
use App\Services\LoggerService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoryReporsitory {
    public function __construct(
        protected LoggerService $logger,
    ) {
        //
    }

    public function getAllByUser($userId, UserStatusEnum $userStatus) {
        $user = User::find($userId);
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
        if ($userStatus->value)
            $publicationStatus = PublicationStatusEnum::PUBLISHED;
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
                    $query->select('id', 'name');
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

    public function getById($id) {
        if (!is_int($id))
            return null;
        $story = Story::with([
            "category" => function($query) {
                $query->select('id', 'name');
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
        ])->find($id);
    }

    public function save(StoryRequestData $requestData, string $coverName, int $userId) {
        $story = Story::create([
            "cover_image" => $coverName,
            "title" => $requestData->title,
            "slug" => null,
            "description" => $requestData->description,
            "tags" => $requestData->tags,
            "rating" => $requestData->rating,
            "story_status" => $requestData->story_status,
            "category_id" => $requestData->category,
            "audience_type_id" => $requestData->audience_type,
            "copyright_type_id" => $requestData->copyright_type,
            "user_id" => $userId
        ]);
        //$story = $story->get
        return $story;
    }
}
