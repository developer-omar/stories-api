<?php

namespace Database\Seeders;

use App\Models\UserState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStateSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        UserState::create([
            'name' => 'Activo',
        ]);
        UserState::create([
            'name' => 'Eliminado',
        ]);
        UserState::create([
            'name' => 'Suspendido',
        ]);
        UserState::create([
            'name' => 'Baneado'
        ]);
    }
}
