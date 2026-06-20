<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
        'actif',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'actif' => 'boolean',
        ];
    }

    // Relations
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function livreur()
    {
        return $this->hasOne(Livreur::class);
    }

    public function paiementsConfirmes()
    {
        return $this->hasMany(Paiement::class, 'confirme_par');
    }

    // Helpers
    public function isGerant()
    {
        return $this->role === 'gerant';
    }

    public function isServeuse()
    {
        return $this->role === 'serveuse';
    }

    public function isCuisine()
    {
        return $this->role === 'cuisine';
    }

    public function isLivreur()
    {
        return $this->role === 'livreur';
    }
}