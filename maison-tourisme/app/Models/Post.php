<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'site_id',
        'type',
        'contenu',
    ];

    /* ===================== */
    /* Relations */
    /* ===================== */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsTo(Sites::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /* ===================== */
    /* Helpers */
    /* ===================== */

    public function isLikedBy($user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->likes()
            ->where('user_id', $user->id)
            ->exists();
    }
    public function reactions()
{
    return $this->hasMany(Reaction::class);
}

public function reactionBy($user)
{
    return $this->reactions()
        ->where('user_id', $user?->id)
        ->first();
}

}
