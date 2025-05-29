<?php require_once __DIR__ . '/layouts/header.php'; ?>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-dark text-white">
    <div class="text-center">
        <h1 class="display-1 fw-bold glitch-text" data-text="404">404</h1>
        <h2 class="display-4 mb-4">Página não encontrada</h2>
        <p class="lead mb-5">Ops! A página que você está procurando não existe.</p>
        <a href="/gamestore" class="btn btn-primary btn-lg btn-glow">
            <i class="fas fa-home me-2"></i>
            Voltar para Home
        </a>
    </div>
</div>

<style>
.glitch-text {
    position: relative;
    font-family: 'Orbitron', sans-serif;
    text-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    animation: glitch 2s infinite;
}

.glitch-text::before,
.glitch-text::after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.glitch-text::before {
    left: 2px;
    text-shadow: -2px 0 #ff00ff;
    clip: rect(24px, 550px, 90px, 0);
    animation: glitch-anim 3s infinite linear alternate-reverse;
}

.glitch-text::after {
    left: -2px;
    text-shadow: -2px 0 #00ff00;
    clip: rect(85px, 550px, 140px, 0);
    animation: glitch-anim2 2s infinite linear alternate-reverse;
}

@keyframes glitch-anim {
    0% { clip: rect(42px, 9999px, 44px, 0); }
    100% { clip: rect(32px, 9999px, 162px, 0); }
}

@keyframes glitch-anim2 {
    0% { clip: rect(12px, 9999px, 59px, 0); }
    100% { clip: rect(1px, 9999px, 130px, 0); }
}

.btn-glow {
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    transition: all 0.3s ease;
}

.btn-glow:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 20px rgba(0, 123, 255, 0.7);
}
</style>

<?php require_once __DIR__ . '/layouts/footer.php'; ?> 