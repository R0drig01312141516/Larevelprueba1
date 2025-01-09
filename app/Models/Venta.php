<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'cliente_id',
        'total',
        'fecha',
        'metodo_pago',
        'tipo_cambio',
        'total_dolares',
        'estado',
        'transaccion_id',
        'payer_email'
    ];

    public $timestamps = false;

    public function casts(): array
    {
        return [
            'fecha' => 'datetime'
        ];
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
