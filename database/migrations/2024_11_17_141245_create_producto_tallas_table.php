<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos_tallas', function (Blueprint $table) {
            $table->bigInteger('producto_id')->unsigned();  // 'producto_id' sigue siendo bigInteger
            $table->bigInteger('talla_id')->unsigned();    // 'talla_id' también será de tipo bigInteger
            $table->integer('cantidad')->default(0);

            // Definir las claves foráneas
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('talla_id')->references('id')->on('tallas')->onDelete('cascade');  // Relacionamos con 'id'

            // Definir la clave primaria compuesta
            $table->primary(['producto_id', 'talla_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos_tallas');
    }
};


