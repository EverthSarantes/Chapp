<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subcategoria;
use App\Models\Categoria;

class SubcategoriaFactory extends Factory
{
    protected $model = Subcategoria::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'categoria_id' => Categoria::factory()
        ];
    }
}