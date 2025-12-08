<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    // Laravel va utiliser la table "sites" automatiquement
    // si ta table porte un autre nom, ajoute: protected $table = '...';

    protected $fillable = [
        'titre',
        'ville',
        'description',
        'image',
        'is_publishing',
    ];

    // Si tu veux manipuler is_publishing comme un booléen
    protected $casts = [
        'is_publishing' => 'boolean',
    ];
}
