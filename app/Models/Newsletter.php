<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'sujet',
        'contenu',
        'type',
        'envoye_at',
        'nombre_destinataires',
    ];

    protected function casts(): array
    {
        return [
            'envoye_at' => 'datetime',
        ];
    }
}