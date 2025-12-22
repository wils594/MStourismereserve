<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Sites;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Affichage du fil de discussion
     */
    public function index()
    {
        $posts = Post::with(['user', 'site', 'comments.user'])
            ->latest()
            ->get();

        $sites = Sites::orderBy('titre')->get();

        return view('discussion.index', compact('posts', 'sites'));
    }

    /**
     * Enregistrer une publication
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type'    => 'required|in:question,avis,recommandation',
            'contenu' => 'required|string|max:2000',
            'site_id' => 'nullable|exists:sites,id',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'type'    => $data['type'],
            'contenu' => $data['contenu'],
            'site_id' => $data['site_id'] ?? null,
        ]);

        return redirect()->route('discussion')->with('success', 'Publication ajoutée');
    }
}
