<?php

namespace App\Data\Authentication;

use App\Data\User\UserData;
use Spatie\LaravelData\Data;

class UserLoginResponseData extends Data {
    public function __construct(
        public string $access_token,
        public string $token_type,
        public int $expires_in,
        public UserData $user,
    ) {
        //
    }

    /*public static function fromModel(
        string $token,
        string $tokenType,
        int $expiresIn,
        User $user
    ) {
        return new self(
            $token,
            $tokenType,
            $expiresIn,
            UserData::from($user)
        );
    }*/
}
