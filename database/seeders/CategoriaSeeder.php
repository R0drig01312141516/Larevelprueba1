<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Hombre',
            'Mujer',
            'Niño',
        ];

        foreach ($categorias as $categoria) {
            Categoria::create([
                'categoria' => $categoria,
            ]);
        }
    }
}
