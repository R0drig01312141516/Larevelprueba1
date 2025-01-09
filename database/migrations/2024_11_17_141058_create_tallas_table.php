<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tallas', function (Blueprint $table) {
            $table->bigIncrements('id');  // Usando 'bigIncrements' para la columna 'id' de tipo bigInteger
            $table->string('talla', 20)->unique();  // 'talla' es un string que representa la talla
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tallas');
    }
};
