<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestoTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'qr_code',
        'statut',
    ];

    // Relations
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function commandesEnCours()
    {
        return $this->hasMany(Commande::class)
            ->whereNotIn('statut', ['livree', 'annulee']);
    }
}