<?php

namespace Database\Seeders;

use App\Models\AudienceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AudienceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AudienceType::create([
            'audience' => 'Grado medio (8-13 años de edad)',
            'age_range' => '8-13',
        ]);
        AudienceType::create([
            'audience' => 'Juvenil (13-18 años de edad)',
            'age_range' => '13-18',
        ]);
        AudienceType::create([
            'audience' => 'Jóvenes Adultos (18-24 años de edad)',
            'age_range' => '18-24',
        ]);
        AudienceType::create([
            'audience' => 'Adulto (25 años de edad)',
            'age_range' => '25+',
        ]);
    }
}
