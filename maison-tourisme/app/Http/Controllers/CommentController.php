<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Enregistrer un commentaire
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'contenu' => 'required|string|max:1000',
        ]);

        Comment::create([
            'post_id' => $data['post_id'],
            'user_id' => auth()->id(),
            'contenu' => $data['contenu'],
        ]);

        return back();
    }

    /**
     * Supprimer un commentaire
     */
    public function destroy(Comment $comment)
    {
        // Autorisation : auteur ou admin
        if (
            auth()->id() !== $comment->user_id &&
            !auth()->user()->is_admin
        ) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé.');
    }
}
