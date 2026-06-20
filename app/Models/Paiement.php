<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'methode',
        'transaction_id',
        'montant',
        'statut',
        'confirme_par',
        'confirme_at',
    ];

    protected function casts(): array
    {
        return [
            'montant' => 'decimal:2',
            'confirme_at' => 'datetime',
        ];
    }

    // Relations
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function confirmePar()
    {
        return $this->belongsTo(User::class, 'confirme_par');
    }
}