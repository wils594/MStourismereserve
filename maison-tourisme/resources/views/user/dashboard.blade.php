<style>
.main-header {
    background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(249,250,251,0.95) 100%);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 2rem 2.5rem;
    box-shadow: 
        0 20px 60px rgba(0, 0, 0, 0.08),
        0 0 0 1px rgba(255, 255, 255, 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
    position: relative;
    overflow: hidden;
}

.main-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #1e40af, #facc15);
    background-size: 300% 100%;
    animation: gradientFlow 4s ease infinite;
}

@keyframes gradientFlow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.main-title {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 45%, #facc15 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    letter-spacing: -0.02em;
    line-height: 1.2;
}

.main-subtitle {
    font-size: 1.05rem;
    color: #6b7280;
    font-weight: 500;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .main-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 1.5rem;
    }
    
    .main-title {
        font-size: 1.5rem;
    }
    
    .main-subtitle {
        font-size: 0.95rem;
    }
    
    .main-header form {
        width: 100%;
    }
    
    .main-header form button {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="main-header">
    <div>
        <div class="main-title">Bonjour, {{ auth()->user()->name ?? 'Utilisateur' }} 👋</div>
        <div class="main-subtitle">
            Bienvenue dans votre espace client de la Maison du Tourisme.
        </div>
    </div>

    {{-- Bouton Déconnexion stylé bleu & jaune --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            type="submit"
            style="
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 0.85rem 1.75rem;
                
                background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 50%, #facc15 100%);
                border: none;
                border-radius: 16px;
                
                font-weight: 700;
                font-size: 0.95rem;
                color: #1f2937;
                cursor: pointer;
                
                box-shadow: 
                    0 8px 24px rgba(59, 130, 246, 0.30),
                    inset 0 1px 0 rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(3px);
                
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            "
            onmouseover="
                this.style.transform='translateY(-3px) scale(1.03)'; 
                this.style.boxShadow='0 12px 32px rgba(59, 130, 246, 0.45), inset 0 1px 0 rgba(255,255,255,0.5)';
                this.querySelector('span').style.transform='rotate(15deg)';
            "
            onmouseout="
                this.style.transform='translateY(0) scale(1)'; 
                this.style.boxShadow='0 8px 24px rgba(59, 130, 246, 0.30), inset 0 1px 0 rgba(255,255,255,0.4)';
                this.querySelector('span').style.transform='rotate(0deg)';
            "
            onmousedown="this.style.transform='translateY(-1px) scale(1.01)'"
        >
            <span style="font-size: 1.15rem; transition: transform 0.3s ease;"></span>
            Déconnexion
        </button>
    </form>
</div>
