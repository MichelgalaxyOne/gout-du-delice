<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $fillable = [
    'categorie_id',
    'nom',
    'description',
    'prix',
    'disponible',
    'temps_preparation',
    'allergenes',
];
    protected function casts(): array
    {
        return [
            'disponible' => 'boolean',
            'prix' => 'decimal:2',
        ];
    }

    // Relations
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }

    public function images()
{
    return $this->hasMany(PlatImage::class);
}

public function imagePrincipale()
{
    return $this->hasOne(PlatImage::class)->where('principale', true);
}
}