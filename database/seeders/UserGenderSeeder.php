<?php

namespace Database\Seeders;

use App\Models\UserGender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserGenderSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        UserGender::create([
            'name' => 'Masculino',
        ]);
        UserGender::create([
            'name' => 'Femenino',
        ]);
        UserGender::create([
            'name' => 'Otro',
        ]);
    }
}
