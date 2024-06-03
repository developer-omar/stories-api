<?php

namespace App\Repositories;

use App\Data\ChangeUserEmailRequestData;
use App\Data\ChangeUserPasswordRequestData;
use App\Data\ChangeUsernameRequestData;
use App\Data\StoreUserRequestData;
use App\Data\UpdateUserRequestData;
use App\Models\User;
use App\Models\UserGender;
use App\Services\LoggerService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository {

    public function __construct(
        protected LoggerService $logger,
    ) {
        //
    }

    public function getById($id = null) {
        if (!is_int($id))
            return null;
        $user = User::with([
            'userGender' => function($query) {
                $query->select('id', 'name');
            },
            'userState' => function($query) {
                $query->select('id', 'name');
            },
        ])->find($id);
        return $user;
    }

    public function findUser(array $where = [], array $orWhere = []) : Model|null {
        $user = User::with([
            'userGender' => function($query) {
                $query->select('id', 'name');
            },
            'userState' => function($query) {
                $query->select('id', 'name');
            },
        ]);
        foreach ($where as $key => $value)
            $user->where($key, $value);
        foreach ($orWhere as $key => $value)
            $user->orWhere($key, $value);
        return $user->first();
    }

    public function save(StoreUserRequestData $requestData) {
        $user = User::create($requestData->toArray());
        return $user;
    }

    public function checkPassword($password, $userId) {
        $user = User::find($userId);
        if (Hash::check($password, $user->password))
            return true;
        return false;
    }

    public function updateEmail(ChangeUserEmailRequestData $userChangeEmailData, $userId) {
        $user = User::find($userId);
        $user->email = $userChangeEmailData->new_email;
        $user->save();
    }


    public function updateUsername(ChangeUsernameRequestData $userChangeUsernameData, $userId) {
        $user = User::find($userId);
        $user->username = $userChangeUsernameData->new_username;
        $user->save();
    }
    public function updatePassword(ChangeUserPasswordRequestData $userChangePasswordRequestData, $userId) {
        $user = User::find($userId);
        $user->password = bcrypt($userChangePasswordRequestData->new_password);
        $user->save();
    }

    public function update(UpdateUserRequestData $userUpdateRequestData, $userId) {
        $userGender = UserGender::find($userUpdateRequestData->gender);
        if(is_null($userGender))
            return null;
        $user = $this->getById($userId);
        $user->photo = $userUpdateRequestData->photo;
        $user->name = $userUpdateRequestData->name;
        $user->last_name = $userUpdateRequestData->last_name;
        $user->birth_date = $userUpdateRequestData->birth_date;
        $user->about_you = $userUpdateRequestData->about_you;
        $user->location = $userUpdateRequestData->location;
        $user->user_gender_id = $userUpdateRequestData->gender;
        $user->save();
        $user->refresh();
        return $user;
    }
}
