<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'nom',
        'actif',
        'token_desabonnement',
    ];

    protected function casts(): array
    {
        return [
            'actif' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscriber) {
            if (empty($subscriber->token_desabonnement)) {
                $subscriber->token_desabonnement = Str::random(40);
            }
        });
    }
}