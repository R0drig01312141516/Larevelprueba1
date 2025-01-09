<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            'Adidas',
            'Nike',
            'Puma',
            'New Balance',
            'Converse',
            'Vans',
            'Fila',
            'Asics',
            'Reebok',
            'Under Armour',
            'Skechers',
            'Hoka One One',
        ];

        foreach ($marcas as $marca) {
            Marca::create([
                'marca' => $marca,
            ]);
        }
    }
}
