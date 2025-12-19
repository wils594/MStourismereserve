<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Maison du Tourisme') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />

<style>
*{margin:0;padding:0;box-sizing:border-box}
body{
    font-family:'Instrument Sans',sans-serif;
    background:#020617;
    color:#fff;
    overflow-x:hidden
}

/* ===== HERO ===== */
.hero-wrapper{
    position:relative;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden
}

/* BLEU + JAUNE animated mesh */
.animated-bg{
    position:absolute;
    inset:0;
    background:
    radial-gradient(at 0% 0%,#1e3a8a 0%,transparent 55%),
    radial-gradient(at 100% 0%,#0ea5e9 0%,transparent 55%),
    radial-gradient(at 100% 100%,#facc15 0%,transparent 50%),
    radial-gradient(at 0% 100%,#1e40af 0%,transparent 55%);
    animation:meshMove 22s ease infinite
}

@keyframes meshMove{
    50%{transform:scale(1.08) rotate(4deg)}
}

.container{
    position:relative;
    z-index:10;
    max-width:1300px;
    padding:2rem
}

.hero-grid{
    display:grid;
    grid-template-columns:1.1fr .9fr;
    gap:4rem;
    align-items:center
}

/* STATUS */
.status-badge{
    display:inline-flex;
    align-items:center;
    gap:.6rem;
    padding:.6rem 1.3rem;
    background:rgba(250,204,21,.12);
    border:1px solid rgba(250,204,21,.35);
    border-radius:100px;
    margin-bottom:2rem
}

.status-dot{
    width:10px;
    height:10px;
    background:#22c55e;
    border-radius:50%
}

/* TITRES */
.main-title{
    font-size:clamp(2.5rem,6vw,5rem);
    font-weight:900;
    line-height:1.1;
    margin-bottom:1.5rem
}

.gradient-text{
    background:linear-gradient(135deg,#facc15,#fde047,#38bdf8);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent
}

.subtitle{
    color:#c7d2fe;
    max-width:540px;
    margin-bottom:2.5rem
}

/* CTA */
.cta-buttons{display:flex;gap:1rem}

.btn{
    padding:1.1rem 2.8rem;
    border-radius:100px;
    font-weight:800;
    text-decoration:none;
    letter-spacing:.2px
}

.btn-primary{
    background:linear-gradient(135deg,#facc15,#fde047);
    color:#020617;
    box-shadow:0 10px 30px rgba(250,204,21,.35)
}

.btn-secondary{
    background:rgba(59,130,246,.08);
    color:#fff;
    border:2px solid rgba(59,130,246,.4)
}

/* ===== 3D MODEL ===== */
.model-3d-wrapper{perspective:1600px}

.model-3d{
    width:100%;
    max-width:420px;
    aspect-ratio:4/5;
    transform-style:preserve-3d;
    transition:transform .15s ease-out
}

.model-3d-card{
    position:relative;
    height:100%;
    border-radius:28px;
    overflow:hidden;
    background:linear-gradient(
        145deg,
        rgba(59,130,246,.25),
        rgba(250,204,21,.08)
    );
    backdrop-filter:blur(22px);
    border:1px solid rgba(255,255,255,.18);
    box-shadow:0 45px 90px rgba(2,6,23,.7);
    transform:translateZ(60px)
}

.model-3d-image{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
    opacity:0;
    transition:opacity .8s ease
}

.model-3d-image.active{opacity:.95}

.model-3d-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(to top,rgba(2,6,23,.88),transparent 60%);
    display:flex;
    align-items:flex-end;
    padding:1.6rem
}

.model-3d-title{
    font-size:1.25rem;
    font-weight:900;
    color:#fde047
}

.model-3d-text{
    font-size:.95rem;
    line-height:1.55;
    color:#e0e7ff
}
</style>
</head>

<body>

<div class="hero-wrapper">
    <div class="animated-bg"></div>

    <div class="container">
        <div class="hero-grid">

            <!-- LEFT -->
            <div>
                <div class="status-badge">
                    <span class="status-dot"></span>
                    <span>Plateforme 100% Digitale</span>
                </div>

                <h1 class="main-title">
                    Explorez, réservez<br>
                    et vivez <span class="gradient-text">Aného</span><br>
                    autrement.
                </h1>

                <p class="subtitle">
                    Découvrez Aného à travers son histoire, ses plages et sa culture vivante.
                </p>

                <div class="cta-buttons">
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Commencer →
                        </a>
                    @endif
                    <a href="#" class="btn btn-secondary">
                        En savoir plus
                    </a>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="model-3d-wrapper">
                <div class="model-3d" id="model3d">
                    <div class="model-3d-card">

                        <img src="images/IMG-20251216-WA0055.jpg" class="model-3d-image active">
                        <img src="images/IMG-20251216-WA0056.jpg" class="model-3d-image">
                        <img src="images/IMG-20251216-WA0057.jpg" class="model-3d-image">
                        <img src="images/IMG-20251216-WA0058.jpg" class="model-3d-image">
                        <img src="images/IMG-20251216-WA0059.jpg" class="model-3d-image">

                        <div class="model-3d-overlay">
                            <div>
                                <div class="model-3d-title" id="aneoTitle">
                                    Aného – Côte historique
                                </div>
                                <div class="model-3d-text" id="aneoText">
                                    Ville côtière emblématique du sud-est du Togo.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
/* ===== 3D INTERACTION ===== */
const model=document.getElementById('model3d');
model.addEventListener('mousemove',e=>{
const r=model.getBoundingClientRect();
const rx=-((e.clientY-r.top)/r.height-.5)*30;
const ry=((e.clientX-r.left)/r.width-.5)*30;
model.style.transform=`rotateX(${rx}deg) rotateY(${ry}deg)`;
});
model.addEventListener('mouseleave',()=>model.style.transform='');

/* ===== IMAGE ROTATION ===== */
const images=document.querySelectorAll('.model-3d-image');
const texts=[
{t:"Aného – Patrimoine historique",d:"Ancienne capitale coloniale, pilier de l’histoire togolaise."},
{t:"Aného – Littoral unique",d:"Entre océan Atlantique et lac Togo."},
{t:"Aného – Culture vivante",d:"Chefferies, traditions et festivals."},
{t:"Aného – Destination touristique",d:"Un cadre idéal pour un tourisme responsable."},
{t:"Aného – Héritage et avenir",d:"Modernité et valorisation locale."}
];

let i=0;
const title=document.getElementById('aneoTitle');
const text=document.getElementById('aneoText');

setInterval(()=>{
images[i].classList.remove('active');
i=(i+1)%images.length;
images[i].classList.add('active');
title.textContent=texts[i].t;
text.textContent=texts[i].d;
},5000);
</script>

</body>
</html>
