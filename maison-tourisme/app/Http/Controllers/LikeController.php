<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $like = Like::where('post_id', $post->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($like) {
            $like->delete(); // unlike
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
            ]);
        }

        return back();
    }
}
