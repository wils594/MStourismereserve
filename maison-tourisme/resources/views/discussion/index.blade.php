<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Communauté – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-900">

<main class="max-w-3xl mx-auto px-4 py-10">
    <!-- ================= RETOUR ACCUEIL ================= -->
<div class="mb-6">
    <a href="{{ route('accueil') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold
              text-blue-900 hover:text-blue-700 transition">
        ← Retour à l’accueil
    </a>
</div>


<!-- ================= TITRE ================= -->
<h1 class="text-3xl font-bold text-blue-900 mb-8 text-center">
    Communauté & Discussions
</h1>

<!-- ================= COMPOSER UN POST ================= -->
@auth
<div class="bg-white rounded-xl border border-slate-200 p-5 mb-8 shadow-sm">
    <form method="POST" action="{{ route('discussion.store') }}">
        @csrf

        <div class="flex gap-3 mb-3">
            <select name="type" class="w-1/3 rounded-lg border px-3 py-2 text-sm">
                <option value="question">❓ Question</option>
                <option value="avis">⭐ Avis</option>
                <option value="recommandation">📍 Recommandation</option>
            </select>

            <select name="site_id" class="w-2/3 rounded-lg border px-3 py-2 text-sm">
                <option value="">Associer à un site (optionnel)</option>
                @foreach($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->titre }}</option>
                @endforeach
            </select>
        </div>

        <textarea
            name="contenu"
            rows="3"
            placeholder="Posez une question, donnez votre avis ou recommandez un site…"
            class="w-full rounded-lg border px-4 py-3 text-sm focus:ring-2 focus:ring-blue-200 outline-none"
            required
        ></textarea>

        <div class="flex justify-end mt-3">
            <button class="px-5 py-2 rounded-full bg-blue-900 text-white text-sm font-semibold">
                Publier
            </button>
        </div>
    </form>
</div>
@endauth

<!-- ================= FIL D’ACTUALITÉ ================= -->
<div class="space-y-6">

@forelse($posts as $post)
<article class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">

<!-- ===== EN-TÊTE ===== -->
<div class="flex items-center gap-3 mb-3">
    <div class="h-10 w-10 rounded-full bg-blue-900 text-white flex items-center justify-center font-bold">
        {{ strtoupper(substr($post->user->name, 0, 1)) }}
    </div>

    <div class="flex-1">
        <p class="font-semibold text-sm">{{ $post->user->name }}</p>
        <p class="text-xs text-slate-500">{{ $post->created_at->diffForHumans() }}</p>
    </div>

    <span class="text-xs px-2 py-1 rounded-full
        {{ $post->type === 'question' ? 'bg-blue-100 text-blue-700' :
           ($post->type === 'avis' ? 'bg-yellow-100 text-yellow-700' :
           'bg-green-100 text-green-700') }}">
        {{ ucfirst($post->type) }}
    </span>
</div>

<!-- ===== CONTENU ===== -->
<p class="text-sm text-slate-800 mb-3 leading-relaxed">
    {{ $post->contenu }}
</p>

@if($post->site)
<div class="text-xs bg-slate-50 border rounded-lg px-3 py-2 mb-3">
    📍 {{ $post->site->titre }}
</div>
@endif

<!-- ===== RÉACTIONS ===== -->
@php
    $counts = $post->reactions->groupBy('type')->map->count();
    $myReaction = auth()->check()
        ? $post->reactions->firstWhere('user_id', auth()->id())
        : null;
@endphp

<div class="flex items-center gap-5 text-xs mb-4">

@auth
@foreach(['like'=>'👍','love'=>'❤️','wow'=>'😮'] as $type => $emoji)
<form method="POST" action="{{ route('posts.reaction', $post) }}">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    <button
        class="font-semibold flex items-center gap-1
        {{ $myReaction?->type === $type ? 'text-blue-700' : 'text-slate-600' }}">
        {{ $emoji }} {{ $counts[$type] ?? 0 }}
    </button>
</form>
@endforeach
@else
<span>👍 {{ $counts['like'] ?? 0 }}</span>
<span>❤️ {{ $counts['love'] ?? 0 }}</span>
<span>😮 {{ $counts['wow'] ?? 0 }}</span>
@endauth

<span class="text-slate-500">
    💬 {{ $post->comments->count() }}
</span>

</div>

<!-- ===== COMMENTAIRES ===== -->
@if($post->comments->count())
<div class="pl-6 border-l space-y-3 mb-3">

@foreach($post->comments as $comment)
<div class="bg-slate-50 rounded-lg px-3 py-2 text-sm">

    <div class="flex justify-between items-start">
        <div>
            <strong>{{ $comment->user->name }}</strong>
            <span class="text-xs text-slate-400">
                · {{ $comment->created_at->diffForHumans() }}
            </span>
        </div>

        @if(auth()->id() === $comment->user_id || auth()->user()->is_admin)
        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
            @csrf
            @method('DELETE')
            <button
                class="text-xs text-red-600 hover:underline"
                onclick="return confirm('Supprimer ce commentaire ?')">
                Supprimer
            </button>
        </form>
        @endif
    </div>

    <div class="mt-1">
        {{ $comment->contenu }}
    </div>

</div>
@endforeach

</div>
@endif

<!-- ===== AJOUT COMMENTAIRE ===== -->
@auth
<form method="POST" action="{{ route('comments.store') }}" class="flex gap-2">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <input
        name="contenu"
        placeholder="{{ $post->type === 'question' ? 'Ajouter une réponse…' : 'Ajouter un commentaire…' }}"
        class="flex-1 rounded-full border px-4 py-2 text-sm"
        required
    >

    <button class="px-4 py-2 rounded-full bg-blue-900 text-white text-xs">
        Envoyer
    </button>
</form>
@endauth

</article>
@empty
<p class="text-center text-sm text-slate-500">
    Aucune discussion pour le moment.
</p>
@endforelse

</div>

</main>
</body>
</html>
