<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'modelo' => fake()->unique()->words(3, true),
            'descripcion' => fake()->paragraph(),
            'imagen_principal' => storage_path('app\public\img\ui\background.webp'),
            'marca_id' => Marca::inRandomOrder()->first()->id,
            'precio' => fake()->numberBetween(300, 600),
            'disponible' => rand(0, 1),
        ];
    }
}
