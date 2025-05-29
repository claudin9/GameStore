<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid px-4 py-5">
    <!-- Hero Section -->
    <div class="hero-section text-white rounded-4 p-5 mb-5 position-relative overflow-hidden">
        <div class="hero-bg"></div>
        <div class="row align-items-center position-relative">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-3 glitch-text" data-text="Explore Nossas Categorias">Explore Nossas Categorias</h1>
                <p class="lead mb-4 text-white-50">Descubra uma seleção premium de jogos, consoles e acessórios para elevar sua experiência gaming.</p>
                <div class="d-flex gap-3">
                    <a href="/gamestore/products" class="btn btn-glow btn-lg">Ver Todos os Produtos</a>
                    <a href="#featured" class="btn btn-neon btn-lg">Produtos em Destaque</a>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-center">
                <div class="hero-icon">
                    <i class="fas fa-gamepad fa-8x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="row g-4 mb-5">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-6 col-lg-3">
                <div class="category-card h-100">
                    <?php
                    $icons = [
                        'games' => 'fas fa-gamepad',
                        'consoles' => 'fas fa-tv',
                        'acessorios' => 'fas fa-headset',
                        'hardware' => 'fas fa-microchip'
                    ];
                    $icon = $icons[$category['slug']] ?? 'fas fa-tags';
                    ?>
                    <div class="category-icon">
                        <i class="<?= $icon ?> fa-3x"></i>
                    </div>
                    <div class="category-content">
                        <h3 class="h4 mb-3"><?= htmlspecialchars($category['name']) ?></h3>
                        <p class="text-white-50 mb-4"><?= htmlspecialchars($category['description']) ?></p>
                        <a href="/gamestore/products?category=<?= $category['slug'] ?>" 
                           class="btn btn-glow w-100">
                            Explorar Categoria
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Featured Products Section -->
    <div id="featured" class="mt-5 pt-5">
        <h2 class="text-white text-center mb-2">Produtos em Destaque</h2>
        <p class="text-white-50 text-center mb-5">Uma seleção especial dos nossos melhores produtos</p>
        <div class="row g-4">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="position-relative">
                            <img src="/gamestore/public/images/products/<?= htmlspecialchars($product['image']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-primary">Destaque</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="card-text text-muted mb-3"><?= htmlspecialchars($product['description']) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                                <div class="btn-group">
                                    <a href="/gamestore/product/<?= $product['id'] ?>" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="newsletter-section p-5 mt-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="text-white mb-3">Fique por dentro das novidades!</h3>
                <p class="text-white-50 mb-4">Receba ofertas exclusivas, atualizações sobre novos produtos e dicas de gaming.</p>
            </div>
            <div class="col-lg-6">
                <form class="d-flex gap-2">
                    <input type="email" class="form-control bg-dark text-white border-light" placeholder="Seu e-mail">
                    <button type="submit" class="btn btn-glow px-4">Inscrever</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .hero-section {
        background: linear-gradient(45deg, var(--primary), var(--secondary));
        margin: -1.5rem -1.5rem 2rem -1.5rem;
        border-radius: 0 0 2rem 2rem !important;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('/gamestore/public/images/hero-pattern.png') center/cover;
        opacity: 0.1;
    }

    .hero-icon {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    .category-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        padding: 2rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--neon-glow);
    }

    .category-icon {
        color: var(--primary);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .category-icon:after {
        content: '';
        position: absolute;
        width: 50px;
        height: 50px;
        background: var(--primary);
        border-radius: 50%;
        opacity: 0.1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1;
    }

    .category-content {
        position: relative;
        z-index: 1;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--neon-glow);
    }

    .product-card .card-img-top {
        transition: all 0.3s ease;
        height: 200px;
        object-fit: cover;
    }

    .product-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .newsletter-section {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?> 