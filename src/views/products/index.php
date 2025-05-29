<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid px-4 py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2">

            <div class="filter-card">
                <h4 class="text-white mb-3">Filtros</h4>
                <form>
                    <div class="mb-3">
                        <label class="form-label text-white-50">Preço</label>
                        <div class="price-range">
                            <input type="number" class="form-control" placeholder="Min">
                            <span class="text-white-50">até</span>
                            <input type="number" class="form-control" placeholder="Max">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white-50">Disponibilidade</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="inStock">
                            <label class="form-check-label text-white-50" for="inStock">Em estoque</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-glow w-100">
                        Aplicar Filtros
                    </button>
                </form>
            </div>
        </div>

        
        <div class="col-lg-10">
          
            <div class="products-hero mb-5">
                <h1 class="display-4 fw-bold text-white mb-4 glitch-text" data-text="Nossos Produtos">
                    Nossos Produtos
                </h1>
                <p class="lead text-white-50 mb-4">Explore nossa coleção de jogos, consoles e acessórios</p>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="mb-0 text-white-50"><?= count($products) ?> produtos encontrados</p>
                <div class="d-flex gap-3 align-items-center">
                    <form action="" method="GET" class="d-flex gap-3 align-items-center">
                        <div class="search-box">
                            <input type="text" name="search" class="form-control" placeholder="Buscar produtos..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                            <button type="submit" class="btn btn-glow">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <select name="sort" class="form-select w-auto bg-dark text-white border-light" onchange="this.form.submit()">
                            <option value="relevance" <?= isset($_GET['sort']) && $_GET['sort'] === 'relevance' ? 'selected' : '' ?>>Mais Relevantes</option>
                            <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'price_asc' ? 'selected' : '' ?>>Menor Preço</option>
                            <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'price_desc' ? 'selected' : '' ?>>Maior Preço</option>
                            <option value="newest" <?= isset($_GET['sort']) && $_GET['sort'] === 'newest' ? 'selected' : '' ?>>Mais Recentes</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="product-card h-100">
                            <div class="product-image">
                                <?php
                                $imagePath = '/gamestore/public/images/products/';
                                if (stripos($product['name'], 'God of War Ragnarök') !== false) {
                                    $imagePath .= 'game1.jpg';
                                } 
                                else if (stripos($product['name'], 'The Last of Us Part II') !== false) {
                                    $imagePath .= 'game2.jpg';
                                }
                                else if (stripos($product['name'], 'Controle DualSense') !== false) {
                                    $imagePath .= 'game 3.jpg';
                                }
                                else if (stripos($product['name'], 'PlayStation 5') !== false) {
                                    $imagePath .= 'game 4.jpg';
                                }
                                else if (stripos($product['name'], 'Xbox Series X') !== false) {    
                                    $imagePath .= 'game 5.jpg';
                                }
                                else if (stripos($product['name'], 'Nintendo Switch OLED') !== false) {    
                                    $imagePath .= 'game 6.jpg';
                                }
                                else if (stripos($product['name'], 'Headset Gamer RGB') !== false) {    
                                    $imagePath .= 'game 7.jpg';
                                }
                                else if (stripos($product['name'], 'Mouse Gamer') !== false) {    
                                    $imagePath .= 'game 8.jpg';
                                }
                                else {
                                    $imagePath .= 'default.jpg';
                                }
                                ?>
                                <img src="<?= $imagePath ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?>"
                                     style="width: 100%; height: 200px; object-fit: cover;">
                                <?php if ($product['stock'] <= 5): ?>
                                    <div class="stock-badge">Últimas Unidades!</div>
                                <?php endif; ?>
                            </div>
                            <div class="product-content">
                                <h3 class="text-white h5"><?= htmlspecialchars($product['name']) ?></h3>
                                <p class="category text-white-50">
                                    <i class="<?= getCategoryIcon($product['category_slug']) ?>"></i>
                                    <?= htmlspecialchars($product['category_name']) ?>
                                </p>
                                <div class="product-price">
                                    <span class="current-price">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                                    <?php if (isset($product['original_price']) && isset($product['discount']) && $product['discount'] > 0): ?>
                                        <span class="original-price">R$ <?= number_format($product['original_price'], 2, ',', '.') ?></span>
                                        <span class="discount-badge">-<?= $product['discount'] ?>%</span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-actions">
                                    <a href="/gamestore/product/<?= $product['id'] ?>" class="btn btn-glow btn-sm">
                                        <i class="fas fa-eye"></i>
                                        Ver Detalhes
                                    </a>
                                    <button class="btn btn-neon btn-sm">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link bg-dark text-white border-light" href="#" tabindex="-1">Anterior</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link bg-primary border-primary" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-dark text-white border-light" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-dark text-white border-light" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-dark text-white border-light" href="#">Próximo</a>
                    </li>
                </ul>
            </nav>
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

body {
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
}


.filter-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.filter-card:hover {
    box-shadow: var(--neon-glow);
}


.category-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.category-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    padding: 0.5rem;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.category-item:hover,
.category-item.active {
    background: rgba(255, 255, 255, 0.1);
    color: var(--primary);
    box-shadow: var(--neon-glow);
}


.search-box {
    position: relative;
    max-width: 500px;
}

.search-box input {
    padding-right: 50px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.search-box button {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 50px;
    border-radius: 0 5px 5px 0;
}


.product-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--neon-glow);
}

.product-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.stock-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255, 0, 0, 0.8);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 5px;
    font-size: 0.8rem;
}

.product-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-price {
    margin: 1rem 0;
}

.current-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--primary);
}

.original-price {
    text-decoration: line-through;
    color: rgba(255, 255, 255, 0.5);
    margin-left: 0.5rem;
}

.discount-badge {
    background: var(--primary);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 5px;
    font-size: 0.8rem;
    margin-left: 0.5rem;
}

.product-actions {
    margin-top: auto;
    padding-top: 1rem;
    display: flex;
    gap: 0.5rem;
}

/* Buttons */
.btn-glow {
    position: relative;
    border: none;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    box-shadow: var(--neon-glow);
    transition: all 0.3s ease;
    color: white;
}

.btn-glow:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 20px rgba(0, 123, 255, 0.7);
    color: white;
}

.btn-neon {
    position: relative;
    border: 2px solid var(--primary);
    overflow: hidden;
    transition: all 0.3s ease;
    color: white;
    background: transparent;
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

@keyframes glitch-anim {
    0% { clip: rect(42px, 9999px, 44px, 0); }
    100% { clip: rect(32px, 9999px, 162px, 0); }
}

@keyframes glitch-anim2 {
    0% { clip: rect(12px, 9999px, 59px, 0); }
    100% { clip: rect(1px, 9999px, 130px, 0); }
}


@media (max-width: 992px) {
    .col-lg-2 {
        margin-bottom: 2rem;
    }
    .filter-card {
        max-width: 300px;
        margin: 0 auto;
    }
    .search-box {
        max-width: 100%;
    }
    .d-flex.gap-3.align-items-center {
        flex-wrap: wrap;
    }
    .form-select {
        width: 100% !important;
    }
}
</style>

<?php
function getCategoryIcon($slug) {
    $icons = [
        'games' => 'fas fa-gamepad',
        'consoles' => 'fas fa-tv',
        'acessorios' => 'fas fa-headset',
        'hardware' => 'fas fa-microchip'
    ];
    
    return $icons[$slug] ?? 'fas fa-folder';
}
?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?> 