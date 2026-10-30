<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'plat_id',
        'image',
        'principale',
    ];

    protected function casts(): array
    {
        return [
            'principale' => 'boolean',
        ];
    }

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }
}