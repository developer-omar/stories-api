<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CategoryIndexResponseData extends Data {
    public function __construct(
        #[DataCollectionOf(CategoryData::class)]
        public DataCollection $categories
    ) {
        //
    }

    public static function fromCollection(Collection $categories) {
        $dataArray = [];
        foreach ($categories as $category)
            $dataArray[] = CategoryData::from($category);
        return new self(CategoryData::collection($dataArray));
    }
}
