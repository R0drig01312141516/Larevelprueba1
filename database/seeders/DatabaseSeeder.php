<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Marca;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\MoonShine\Models\MoonshineUser;
use App\Models\Oferta;
use App\Models\Talla;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Agregar el usuario administrador
        MoonshineUser::create([
            'name' => 'Administrador',
            'email' => 'admin@zapateriayuly.com',
            'password' => Hash::make('admin.password-123'),
        ]);

        $this->call([
            TallaSeeder::class,
            CategoriaSeeder::class,
            MarcaSeeder::class,
        ]);

        // Crear productos por categoría
        $categorias = Categoria::all();
        $tallas = Talla::all();

        foreach ($categorias as $categoria) {
            Producto::factory(20)->create([
                'categoria_id' => $categoria->id,
            ])->each(function ($producto) use ($tallas) {
                // Asignar tallas aleatorias a cada producto
                $tallasAleatorias = $tallas->random(rand(3, 6));
                foreach ($tallasAleatorias as $talla) {
                    $producto->tallas()->attach($talla->id, [
                        'cantidad' => rand(1, 20)
                    ]);
                }

                // Crear oferta para algunos productos (30% de probabilidad)
                if (rand(1, 100) <= 30) {
                    Oferta::create([
                        'producto_id' => $producto->id,
                        'porcentaje' => rand(10, 50),
                        'fecha_inicio' => now(),
                        'fecha_fin' => now()->addDays(rand(5, 30)),
                    ]);
                }
            });
        }
    }
}
