<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $request->validate([
            'type' => 'required|in:like,love,wow',
        ]);

        $reaction = Reaction::where('post_id', $post->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($reaction) {
            // même réaction → supprimer
            if ($reaction->type === $request->type) {
                $reaction->delete();
            } else {
                // changer de réaction
                $reaction->update(['type' => $request->type]);
            }
        } else {
            Reaction::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
                'type'    => $request->type,
            ]);
        }

        return back();
    }
}
