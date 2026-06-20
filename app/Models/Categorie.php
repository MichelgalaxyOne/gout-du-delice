<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone',
        'ordre',
        'actif',
    ];

    protected function casts(): array
    {
        return [
            'actif' => 'boolean',
        ];
    }

    // Relations
    public function plats()
    {
        return $this->hasMany(Plat::class);
    }

    public function platsDisponibles()
    {
        return $this->hasMany(Plat::class)->where('disponible', true);
    }
}