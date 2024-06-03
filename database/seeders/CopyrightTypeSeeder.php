<?php

namespace Database\Seeders;

use App\Models\CopyrightType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CopyrightTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        CopyrightType::create([
            'copyright' => 'Todos los derechos reservados',
        ]);
        CopyrightType::create([
            'copyright' => 'Dominio Público',
        ]);
        CopyrightType::create([
            'copyright' => 'Atribución de Creative Commons (CC)',
        ]);
        CopyrightType::create([
            'copyright' => 'Atribución de (CC) No Comercial',
        ]);
        CopyrightType::create([
            'copyright' => 'Atrib. de (CC) Sin Derivados',
        ]);
        CopyrightType::create([
            'copyright' => 'Atrib. de (CC) No Com. ShareAlike',
        ]);
        CopyrightType::create([
            'copyright' => 'Atribución de (CC) ShareAlike',
        ]);
        CopyrightType::create([
            'copyright' => 'Atribución de (CC) Sin Derivados',
        ]);
    }
}
