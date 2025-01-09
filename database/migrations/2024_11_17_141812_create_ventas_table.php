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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->decimal('total', 10, 2);
            $table->timestamp('fecha')->useCurrent();
            $table->string('metodo_pago')->nullable();
            $table->decimal('tipo_cambio', 10, 2)->nullable();
            $table->decimal('total_dolares', 10, 2)->nullable();
            $table->string('estado')->default('Pendiente');
            $table->string('transaccion_id')->nullable();
            $table->string('payer_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
