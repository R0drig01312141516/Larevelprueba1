<?php

namespace Database\Seeders;

use App\Models\Talla;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tallas = ['28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50'];

        foreach ($tallas as $talla) {
            Talla::create([
                'talla' => $talla,
            ]);
        }
    }
}
