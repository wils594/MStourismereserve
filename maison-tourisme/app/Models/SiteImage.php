<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $fillable = ['site_id', 'path'];

    public function site()
    {
        return $this->belongsTo(Sites::class);
    }
}
