<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Subcategoria;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cat = Categoria::all();
        $cat->each->delete();

        $categories = [
            'Programación',
            'Diseño Gráfico',
            'Marketing',
            'Idiomas',
            'Negocios',
            'Electricidad',
            'Construcción',
            'Marketing',
            'Educación',
            'Comercio',
            'Finanzas',
        ];

        foreach ($categories as $category) {
            $category = Categoria::create(['nombre' => $category]);
        }
    }
}