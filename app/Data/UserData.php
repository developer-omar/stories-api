<?php

namespace App\Data;

use App\Models\UserGender;
use App\Models\UserProfile;
use App\Models\UserState;
use PhpOption\Option;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserData extends Data {
    public function __construct(
        public int            $id,
        public string         $email,
        public string|null    $photo,
        public string         $username,
        public string         $name,
        public string         $last_name,
        public string         $birth_date,
        public string|null    $about_you,
        public string|null    $location,
        #[MapInputName('user_gender')]
        public UserGenderData $gender,
        #[MapInputName('user_state')]
        public UserStateData  $state,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d\TH:i:s")]
        public \DateTime      $created_at,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d\TH:i:s")]
        public \DateTime      $updated_at,
    ) {
        //
    }

    /*public static function fromModel(
        int         $id,
        string      $email,
        string|null $photo,
        string      $username,
        string      $name,
        string      $last_name,
        string      $birth_date,
        string|null $about_you,
        UserGender  $userGender,
        UserState   $userState,
        \DateTime   $createdAt,
        \DateTime   $updatedAt,
    ) {
        return new self(
            $id,
            $email,
            $photo,
            $username,
            $name,
            $last_name,
            $birth_date,
            $about_you,
            UserGenderData::from($userGender),
            UserStateData::from($userState),
            $createdAt,
            $updatedAt,
        );
    }*/
}
