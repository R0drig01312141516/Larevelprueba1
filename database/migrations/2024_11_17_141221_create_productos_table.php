<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo', 50)->unique();
            $table->text('descripcion')->nullable();
            $table->string('slug')->unique();
            $table->string('imagen_principal')->nullable();
            $table->foreignId('marca_id')
                ->constrained('marcas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->decimal('precio', 10, 2);
            $table->boolean('disponible')->default(true);
            $table->timestamp('registrado_en')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
