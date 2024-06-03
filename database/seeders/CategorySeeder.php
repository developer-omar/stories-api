<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Category::create([
            'name' => 'Accion',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Aventura',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Chick-Lit',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Ciencia Ficción',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Clásicos',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Comics',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Crimen',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Cuento',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'De Todo',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Drama',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Erótico',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Espiritual',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Fanfiction',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Fantasía',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Ficción General',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Guiones',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Historias de vida',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Hombres lobo',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Humor',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Infantil',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Inspiracional',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'LGBT',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Misterio',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'No Ficción',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Novela Histórica',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Novela Juvenil',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Paranormal',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Poesía',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Post-apocalíptico',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Romance',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Suspenso',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Terror',
            'slug' => null,
        ]);
        Category::create([
            'name' => 'Vampiros',
            'slug' => null,
        ]);
    }
}
