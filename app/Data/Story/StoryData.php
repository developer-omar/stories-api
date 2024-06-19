<?php

namespace App\Data\Story;

use App\Data\AudienceType\AudienceTypeData;
use App\Data\Category\CategoryData;
use App\Data\Chapter\ChapterData;
use App\Data\CopyrightType\CopyrightTypeData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class StoryData extends Data
{
    public function __construct(
        public int|Optional $id,
        public string|null $cover_image,
        public string $title,
        public string $slug,
        public string $description,
        public string $tags,
        public int $rating,
        public int $story_status,
        public CategoryData $category,
        public AudienceTypeData $audience_type,
        public CopyrightTypeData $copyright_type,
        #[MapInputName('user')]
        public StoryAuthorData $author,
        #[MapInputName('chapters_count')]
        public int $chapters_number,
        #[DataCollectionOf(ChapterData::class)]
        public DataCollection|Optional $chapters,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d H:i")]
        public \DateTime $created_at,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d H:i")]
        public \DateTime $updated_at,
    ) {}
}
