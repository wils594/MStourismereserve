<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'titre',
        'ville',
        'description',
        'image_url',      //  on garde uniquement "image_url"
        'is_publishing',
    ];

    protected $casts = [
        'is_publishing' => 'boolean',
    ];
}
