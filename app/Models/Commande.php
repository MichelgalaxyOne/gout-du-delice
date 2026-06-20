<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'resto_table_id',
        'user_id',
        'type',
        'mode_livraison',
        'adresse_livraison',
        'statut',
        'mode_paiement',
        'statut_paiement',
        'montant_total',
        'note_client',
        'estimation_temps',
    ];

    protected function casts(): array
    {
        return [
            'montant_total' => 'decimal:2',
        ];
    }

    // Relations
    public function table()
    {
        return $this->belongsTo(RestoTable::class, 'resto_table_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CommandeItem::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    public function livraison()
    {
        return $this->hasOne(Livraison::class);
    }

    // Helper : génère une référence unique
    public static function genererReference()
    {
        $dernier = self::latest('id')->first();
        $numero = $dernier ? $dernier->id + 1 : 1;
        return 'CMD-' . str_pad($numero, 5, '0', STR_PAD_LEFT);
    }
}