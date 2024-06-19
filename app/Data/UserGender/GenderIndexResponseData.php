<?php

namespace App\Data\UserGender;

use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GenderIndexResponseData extends Data
{
    public function __construct(
        #[DataCollectionOf(UserGenderData::class)]
        public DataCollection $genders
    ) {}

    /*public static function fromCollection(Collection $genders) {
        $dataArray = [];
        foreach ($genders as $gender)
            $dataArray[] = UserGenderData::from($gender);
        return new self(UserGenderData::collection($dataArray));
    }*/
}
