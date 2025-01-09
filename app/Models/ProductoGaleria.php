<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductoGaleria extends Model
{
    use HasFactory;

    protected $table = 'producto_galeria';

    protected $fillable = [
        'producto_id',
        'imagen_galeria'
    ];

    public $timestamps = false;

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
