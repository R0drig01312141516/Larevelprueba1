<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    public $timestamps = false;

    protected $fillable = [
        'modelo',
        'descripcion',
        'slug',
        'imagen_principal',
        'marca_id',
        'categoria_id',
        'precio',
        'disponible',
        'codigo',

    ];

    protected $appends = ['precio_final'];

    public function casts(): array
    {
        return [
            'registrado_en' => 'datetime',
        ];
    }

    public function setModeloAttribute($value)
    {
        $this->attributes['modelo'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function tallas(): BelongsToMany
    {
        return $this->belongsToMany(Talla::class, 'productos_tallas',)
            ->withPivot('cantidad');
    }

    public function galeria(): HasMany
    {
        return $this->hasMany(ProductoGaleria::class);
    }

    public function oferta(): HasOne
    {
        return $this->hasOne(Oferta::class)
            ->activa();
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }

    public function getPrecioFinalAttribute()
    {
        if (!$this->oferta) {
            return $this->precio;
        }

        return $this->precio * (1 - $this->oferta->porcentaje / 100);
    }
}
