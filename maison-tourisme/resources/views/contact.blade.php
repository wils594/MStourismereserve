<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Contact – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col bg-slate-50 text-slate-900">

<!-- NAVBAR -->
<nav class="w-full bg-blue-900 border-b border-yellow-400/60">
    <div class="w-full px-8 py-4 flex items-center justify-between">

        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="h-9 rounded-md">
            <span class="text-white font-bold text-sm tracking-wide">
                Maison du Tourisme
            </span>
        </div>

        <div class="hidden md:flex gap-10 text-sm font-semibold">
            <a href="{{ route('home') }}" class="text-white hover:text-yellow-300">Accueil</a>
            <a href="{{ route('apropos') }}" class="text-white hover:text-yellow-300">À propos</a>
            <a href="{{ route('contact') }}" class="text-yellow-300">Contact</a>
        </div>
    </div>
</nav>

<!-- CONTENU -->
<main class="flex-1 w-full px-8 py-14">

    <section class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-10">

        <h1 class="text-3xl font-bold text-blue-900 mb-6">
            Nous contacter
        </h1>

        <p class="text-slate-700 leading-relaxed mb-8">
            Une question, une suggestion ou une demande de partenariat ?
            N’hésitez pas à nous écrire via le formulaire ci-dessous.
        </p>

        <!-- FORMULAIRE -->
        <form method="POST" action="#" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Nom complet
                </label>
                <input
                    type="text"
                    name="nom"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 outline-none"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Adresse email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 outline-none"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Message
                </label>
                <textarea
                    name="message"
                    rows="5"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 outline-none"
                ></textarea>
            </div>

            <button
                type="submit"
                class="px-6 py-2 rounded-full bg-blue-900 text-yellow-300 font-semibold hover:bg-blue-800 transition"
            >
                Envoyer le message
            </button>
        </form>

    </section>

</main>

</body>
</html>
