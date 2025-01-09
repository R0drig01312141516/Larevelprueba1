<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ClientesResetPasswordNotification;

class Cliente extends Authenticatable
{
    use Notifiable, CanResetPassword;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'email_registrado_en'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'email_registrado_en' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientesResetPasswordNotification($token));
    }
    
}
