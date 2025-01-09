<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoTalla extends Model
{
    protected $table = 'productos_tallas';

    protected $fillable = [
        'producto_id',
        'talla_id',
        'cantidad'
    ];

    public $timestamps = false;

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
