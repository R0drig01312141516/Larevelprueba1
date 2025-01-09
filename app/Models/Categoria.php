<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'categoria',
        'slug'
    ];

    public $timestamps = false;

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    public function setCategoriaAttribute($value)
    {
        $this->attributes['categoria'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

}
