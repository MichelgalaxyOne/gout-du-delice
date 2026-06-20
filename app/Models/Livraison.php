<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'livreur_id',
        'adresse',
        'statut',
        'heure_depart',
        'heure_arrivee',
    ];

    protected function casts(): array
    {
        return [
            'heure_depart' => 'datetime',
            'heure_arrivee' => 'datetime',
        ];
    }

    // Relations
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}