<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Verificar si el usuario es usuario normal
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Relación con Tamagochi
     */
    public function tamagochi()
    {
        return $this->hasOne(Tamagochi::class);
    }

    /**
     * Relación con Estadísticas del usuario
     */
    public function statistic()
    {
        return $this->hasOne(UserStatistic::class);
    }

    /**
     * Relación con Configuración del usuario
     */
    public function setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    /**
     * Crear estadísticas y configuración cuando se crea un usuario
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            // Crear tamagochi
            $user->tamagochi()->create([
                'name' => 'Mi Tamagochi',
                'status' => 'normal',
            ]);

            // Crear estadísticas
            $user->statistic()->create();

            // Crear configuración
            $user->setting()->create();
        });
    }
}
