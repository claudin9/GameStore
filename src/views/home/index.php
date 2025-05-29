<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="hero-section position-relative min-vh-100 d-flex align-items-center">
  
    <div id="particles-js"></div>
    
    
    <div class="neon-grid"></div>
    
   
    <div class="container position-relative z-index-1">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start">
               
                <h1 class="display-1 fw-bold mb-4 text-white glitch-text" data-text="GAMESTORE">
                    GAMESTORE
                </h1>
                
               
                <h2 class="display-5 fw-bold mb-4 text-gradient animate__animated animate__fadeInUp">
                    Seu Portal Para o 
                    <span class="text-primary">Mundo Gamer</span>
                </h2>
                
                
                <p class="lead text-white-50 mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                    Descubra as últimas novidades em games, consoles e acessórios. 
                    Entre no jogo com os melhores preços!
                </p>
                
          
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start mb-5 animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="/gamestore/products" class="btn btn-primary btn-lg btn-glow">
                        <i class="fas fa-gamepad me-2"></i>
                        Explorar Produtos
                    </a>
                    <a href="/gamestore/contact" class="btn btn-outline-light btn-lg btn-neon">
                        <i class="fas fa-envelope me-2"></i>
                        Contato
                    </a>
                </div>
                
               
                <div class="row g-4 stats-container">
                    <div class="col-md-4">
                        <div class="stat-card animate__animated animate__fadeInUp animate__delay-3s">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number" data-target="10000">10K+</div>
                            <div class="stat-label">Gamers</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card animate__animated animate__fadeInUp animate__delay-3s">
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stat-number">4.9</div>
                            <div class="stat-label">Rating</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card animate__animated animate__fadeInUp animate__delay-3s">
                            <div class="stat-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="stat-number">1K+</div>
                            <div class="stat-label">Produtos</div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-4 d-none d-lg-block">
                <div class="position-relative">
                    <div class="neon-circle"></div>
                    <div class="floating-elements">
                        <i class="fas fa-gamepad floating-icon-1"></i>
                        <i class="fas fa-headset floating-icon-2"></i>
                        <i class="fas fa-keyboard floating-icon-3"></i>
                        <i class="fas fa-mouse floating-icon-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #007bff;
    --secondary: #6f42c1;
    --neon-glow: 0 0 10px rgba(0, 123, 255, 0.5),
                 0 0 20px rgba(0, 123, 255, 0.3),
                 0 0 30px rgba(0, 123, 255, 0.1);
}

.hero-section {
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
    overflow: hidden;
}


#particles-js {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}


.neon-grid {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(transparent 0%, rgba(0, 123, 255, 0.05) 2%, transparent 3%),
        linear-gradient(90deg, transparent 0%, rgba(0, 123, 255, 0.05) 2%, transparent 3%);
    background-size: 50px 50px;
    animation: gridMove 20s linear infinite;
    opacity: 0.5;
}


.glitch-text {
    position: relative;
    font-family: 'Orbitron', sans-serif;
    text-shadow: var(--neon-glow);
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


.text-gradient {
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}


.btn-glow {
    position: relative;
    border: none;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    box-shadow: var(--neon-glow);
    transition: all 0.3s ease;
}

.btn-glow:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 20px rgba(0, 123, 255, 0.7);
}

.btn-neon {
    position: relative;
    border: 2px solid var(--primary);
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-neon::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: 0.5s;
}

.btn-neon:hover::before {
    left: 100%;
}


.stat-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--neon-glow);
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: 1rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: white;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1rem;
}


.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
}

.floating-elements i {
    position: absolute;
    font-size: 2rem;
    color: var(--primary);
    animation: float 3s ease-in-out infinite;
}

.floating-icon-1 { top: 20%; left: 20%; animation-delay: 0s; }
.floating-icon-2 { top: 60%; left: 80%; animation-delay: 1s; }
.floating-icon-3 { top: 80%; left: 40%; animation-delay: 2s; }
.floating-icon-4 { top: 30%; left: 60%; animation-delay: 1.5s; }


.neon-circle {
    position: absolute;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(0,123,255,0.1) 0%, transparent 70%);
    animation: pulse 2s infinite;
}


@keyframes float {
    0% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
    100% { transform: translateY(0) rotate(360deg); }
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 0.6; }
    50% { transform: scale(1.1); opacity: 0.8; }
    100% { transform: scale(1); opacity: 0.6; }
}

@keyframes gridMove {
    0% { transform: translateY(0); }
    100% { transform: translateY(50px); }
}

@keyframes glitch-anim {
    0% { clip: rect(42px, 9999px, 44px, 0); }
    100% { clip: rect(32px, 9999px, 162px, 0); }
}

@keyframes glitch-anim2 {
    0% { clip: rect(12px, 9999px, 59px, 0); }
    100% { clip: rect(1px, 9999px, 130px, 0); }
}


.z-index-1 {
    z-index: 1;
}


@media (max-width: 992px) {
    .hero-section {
        text-align: center;
        padding: 4rem 0;
    }
    
    .btn-glow, .btn-neon {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .stat-card {
        margin-bottom: 2rem;
    }
}
</style>


<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
particlesJS('particles-js', {
    particles: {
        number: { value: 80, density: { enable: true, value_area: 800 } },
        color: { value: '#007bff' },
        shape: { type: 'circle' },
        opacity: { value: 0.5, random: false },
        size: { value: 3, random: true },
        line_linked: {
            enable: true,
            distance: 150,
            color: '#007bff',
            opacity: 0.4,
            width: 1
        },
        move: {
            enable: true,
            speed: 2,
            direction: 'none',
            random: false,
            straight: false,
            out_mode: 'out',
            bounce: false
        }
    },
    interactivity: {
        detect_on: 'canvas',
        events: {
            onhover: { enable: true, mode: 'repulse' },
            onclick: { enable: true, mode: 'push' },
            resize: true
        }
    },
    retina_detect: true
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?> 