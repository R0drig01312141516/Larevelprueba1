<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Talla extends Model
{
    protected $table = 'tallas';

    protected $fillable = [
        'talla'
    ];

    public $timestamps = false;

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'productos_tallas')
            ->withPivot('cantidad');
    }
}
