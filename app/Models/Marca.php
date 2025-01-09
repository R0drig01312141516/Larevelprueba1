<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marca extends Model
{
    use HasFactory;
    protected $table = 'marcas';

    protected $fillable = [
        'marca'
    ];

    public $timestamps = false;

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}
