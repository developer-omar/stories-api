<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserGender;
use App\Models\UserProfile;
use App\Models\UserState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
//clases of belongsTo
        $userGender = UserGender::find(UserGender::MALE);
        $userState = UserState::find(UserState::ACTIVE);
        //create user administrator
        $user = new User();
        $user->email = 'omar@mail.com';
        $user->password = bcrypt('Admin123,.');

        $user->photo = null;
        $user->username = 'oenrique';
        $user->name = 'omar';
        $user->last_name = 'quispe';
        $user->birth_date = '1984-02-05';
        $user->about_you = null;
        $user->userGender()->associate($userGender);

        $user->userState()->associate($userState);
        $user->save();
    }
}
