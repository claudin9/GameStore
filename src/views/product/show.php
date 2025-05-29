<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="product-detail-page bg-dark text-white">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/gamestore" class="text-light">Home</a></li>
                <li class="breadcrumb-item"><a href="/gamestore/products" class="text-light">Produtos</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page"><?= htmlspecialchars($product['name']) ?></li>
            </ol>
        </nav>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="product-image-wrapper">
                    <div class="neon-border">
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
                             class="img-fluid rounded-3">
                    </div>
                    <?php if ($product['stock'] <= 5): ?>
                        <div class="stock-badge">Últimas Unidades!</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product-info">
                    <h1 class="display-4 fw-bold mb-4 glitch-text" data-text="<?= htmlspecialchars($product['name']) ?>">
                        <?= htmlspecialchars($product['name']) ?>
                    </h1>
                    
                    <div class="mb-4">
                        <div class="price-wrapper">
                            <span class="current-price">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                            <?php if (isset($product['original_price']) && isset($product['discount'])): ?>
                                <span class="original-price">R$ <?= number_format($product['original_price'], 2, ',', '.') ?></span>
                                <span class="discount-badge">-<?= $product['discount'] ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="payment-info">
                            em até 12x de R$ <?= number_format($product['price'] / 12, 2, ',', '.') ?>
                        </div>
                    </div>

                    <div class="description mb-4">
                        <h5 class="text-primary mb-3">Descrição</h5>
                        <p class="text-white-50"><?= htmlspecialchars($product['description']) ?></p>
                    </div>

                    <div class="stock-info mb-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fas fa-box text-primary"></i>
                            <span>Status:</span>
                            <?php if ($product['stock'] > 0): ?>
                                <span class="text-success">Em Estoque</span>
                            <?php else: ?>
                                <span class="text-danger">Fora de Estoque</span>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-truck text-primary"></i>
                            <span>Entrega:</span>
                            <span class="text-success">Frete Grátis</span>
                        </div>
                    </div>

                    <div class="purchase-actions">
                        <div class="quantity-selector mb-3">
                            <button class="btn btn-outline-primary" onclick="updateQuantity(-1)">-</button>
                            <input type="number" id="quantity" value="1" min="1" max="<?= $product['stock'] ?>" class="form-control">
                            <button class="btn btn-outline-primary" onclick="updateQuantity(1)">+</button>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 col-md-6 mb-3">
                                <button class="btn-gamer btn-primary-gamer" onclick="addToCart(<?= htmlspecialchars(json_encode($product)) ?>)">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Adicionar ao Carrinho</span>
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="btn-gamer btn-outline-gamer">
                                    <i class="fas fa-credit-card"></i>
                                    <span>Comprar Agora</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-detail-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
}

.product-image-wrapper {
    position: relative;
    padding: 10px;
}

.neon-border {
    position: relative;
    border-radius: 15px;
    padding: 3px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    animation: borderGlow 2s infinite;
}

.neon-border img {
    border-radius: 12px;
    transition: transform 0.3s ease;
}

.neon-border:hover img {
    transform: scale(1.02);
}

.stock-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #dc3545;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: bold;
    animation: pulse 2s infinite;
}

.price-wrapper {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.current-price {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--primary-color);
}

.original-price {
    font-size: 1.5rem;
    text-decoration: line-through;
    color: rgba(255, 255, 255, 0.5);
}

.discount-badge {
    background: #28a745;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-weight: bold;
}

.payment-info {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.quantity-selector {
    display: flex;
    align-items: center;
    gap: 1rem;
    max-width: 200px;
}

.quantity-selector input {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.quantity-selector input:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: var(--primary-color);
    color: white;
}

@keyframes borderGlow {
    0% { box-shadow: 0 0 10px var(--primary-color); }
    50% { box-shadow: 0 0 20px var(--primary-color); }
    100% { box-shadow: 0 0 10px var(--primary-color); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.cart-notification {
    z-index: 9999;
}

.cart-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item-image {
    border-radius: 4px;
}

.cart-total {
    background: rgba(255, 255, 255, 0.05);
}

.btn-gamer.btn-primary-gamer {
    background: linear-gradient(45deg, #2b1055, #7597de);
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    color: white;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(37, 16, 85, 0.3);
    width: 100%;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.btn-gamer.btn-primary-gamer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #7597de, #2b1055);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.btn-gamer.btn-primary-gamer:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 20px rgba(37, 16, 85, 0.4);
    color: white;
}

.btn-gamer.btn-primary-gamer:hover::before {
    opacity: 1;
}

.btn-gamer.btn-primary-gamer:active {
    transform: translateY(1px) scale(0.98);
}

.btn-gamer.btn-primary-gamer i {
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
    background: linear-gradient(45deg, #fff, #e0e0e0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease;
    margin-right: 8px;
}

.btn-gamer.btn-primary-gamer:hover i {
    transform: rotate(-5deg);
    background: linear-gradient(45deg, #fff, #fff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.btn-gamer.btn-primary-gamer span {
    position: relative;
    z-index: 1;
}

.btn-gamer.btn-primary-gamer::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        45deg,
        transparent,
        rgba(255, 255, 255, 0.1),
        transparent
    );
    transform: rotate(45deg);
    transition: all 0.6s ease;
    opacity: 0;
}

.btn-gamer.btn-primary-gamer:hover::after {
    opacity: 1;
    transform: rotate(45deg) translate(50%, -50%);
}

.btn-gamer.btn-outline-gamer {
    background: transparent;
    border: 2px solid #7597de;
    border-radius: 12px;
    padding: 12px 20px;
    color: #7597de;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
    width: 100%;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.btn-gamer.btn-outline-gamer:hover {
    background: rgba(117, 151, 222, 0.1);
    color: #fff;
    border-color: #2b1055;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(37, 16, 85, 0.2);
}

.btn-gamer.btn-outline-gamer i {
    margin-right: 8px;
    transition: all 0.3s ease;
}

.btn-gamer.btn-outline-gamer:hover i {
    transform: translateX(3px);
}
</style>

<script>
function updateQuantity(change) {
    const input = document.getElementById('quantity');
    const currentValue = parseInt(input.value);
    const maxValue = parseInt(input.max);
    
    let newValue = currentValue + change;
    if (newValue < 1) newValue = 1;
    if (newValue > maxValue) newValue = maxValue;
    
    input.value = newValue;
}

function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const existingItemIndex = cart.findIndex(item => item.name === product.name);
    
    if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity = parseInt(cart[existingItemIndex].quantity) + parseInt(product.quantity);
    } else {
        cart.push({
            name: product.name,
            price: product.price,
            image: product.image,
            quantity: parseInt(product.quantity)
        });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    
    updateCartCount();
    showCartNotification();
    updateCartDropdown();
}

function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const totalItems = cart.reduce((total, item) => total + parseInt(item.quantity), 0);
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = totalItems;
        cartCountElement.style.display = totalItems > 0 ? 'block' : 'none';
    }
}

function showCartNotification() {
    const notification = document.createElement('div');
    notification.className = 'cart-notification';
    notification.innerHTML = `
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
            Produto adicionado ao carrinho!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function updateCartDropdown() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartDropdown = document.getElementById('cart-dropdown');
    
    if (!cartDropdown) return;
    
    let total = 0;
    let cartHtml = '';
    
    if (cart.length === 0) {
        cartHtml = '<p class="text-center text-muted my-3">Carrinho vazio</p>';
    } else {
        cartHtml = cart.map(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            return `
                <div class="cart-item d-flex align-items-center gap-2 p-2">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image" style="width: 50px; height: 50px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <h6 class="mb-0">${item.name}</h6>
                        <small class="text-muted">Qtd: ${item.quantity} x R$ ${item.price.toFixed(2)}</small>
                    </div>
                    <button onclick="removeFromCart('${item.name}')" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
        }).join('');
        
        cartHtml += `
            <div class="cart-total p-3 border-top">
                <div class="d-flex justify-content-between mb-2">
                    <strong>Total:</strong>
                    <span>R$ ${total.toFixed(2)}</span>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-sm">Finalizar Compra</button>
                    <button onclick="clearCart()" class="btn btn-outline-danger btn-sm">Limpar Carrinho</button>
                </div>
            </div>
        `;
    }
    
    cartDropdown.innerHTML = cartHtml;
}

function removeFromCart(name) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.name !== name);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDropdown();
}

function clearCart() {
    localStorage.removeItem('cart');
    updateCartCount();
    updateCartDropdown();
}

document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    updateCartDropdown();
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?> 