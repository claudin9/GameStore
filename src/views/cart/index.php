<!-- Cart Header -->
<div class="cart-header">
    <div class="container">
        <h1 class="page-title">Carrinho de Compras</h1>
    </div>
</div>

<!-- Cart Content -->
<div class="cart-content">
    <div class="container">
        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Seu carrinho está vazio</h2>
                <p>Adicione produtos ao seu carrinho para continuar comprando.</p>
                <a href="/gamestore/produtos" class="btn btn-primary">Ver Produtos</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <!-- Cart Items -->
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item" id="cart-item-<?= $item['id'] ?>">
                            <div class="item-image">
                                <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>">
                            </div>
                            <div class="item-info">
                                <h3 class="item-title"><?= $item['name'] ?></h3>
                                <p class="item-category"><?= $item['category_name'] ?></p>
                                <div class="item-price">
                                    R$ <?= number_format($item['price'], 2, ',', '.') ?>
                                </div>
                            </div>
                            <div class="item-quantity">
                                <div class="quantity-selector">
                                    <button onclick="updateCartItem(<?= $item['id'] ?>, 'decrease')">-</button>
                                    <input type="number" value="<?= $item['quantity'] ?>" 
                                           min="1" max="<?= $item['stock'] ?>" 
                                           onchange="updateCartItem(<?= $item['id'] ?>, 'set', this.value)">
                                    <button onclick="updateCartItem(<?= $item['id'] ?>, 'increase')">+</button>
                                </div>
                            </div>
                            <div class="item-total">
                                R$ <?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?>
                            </div>
                            <div class="item-actions">
                                <button class="btn btn-icon" onclick="removeFromCart(<?= $item['id'] ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h2>Resumo do Pedido</h2>
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Frete</span>
                        <span>Calculado no checkout</span>
                    </div>
                    <div class="summary-item total">
                        <span>Total</span>
                        <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
                    </div>
                    <div class="summary-actions">
                        <a href="/gamestore/produtos" class="btn btn-outline">Continuar Comprando</a>
                        <a href="/gamestore/carrinho/checkout" class="btn btn-primary">Finalizar Compra</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function updateCartItem(productId, action, value = null) {
    let quantity;
    const input = document.querySelector(`#cart-item-${productId} input[type="number"]`);
    const currentValue = parseInt(input.value);
    
    switch (action) {
        case 'increase':
            quantity = currentValue + 1;
            break;
        case 'decrease':
            quantity = currentValue - 1;
            break;
        case 'set':
            quantity = parseInt(value);
            break;
    }
    
    if (quantity >= 1 && quantity <= parseInt(input.max)) {
        fetch('/gamestore/carrinho/atualizar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartDisplay(data);
            } else {
                showNotification(data.message || 'Erro ao atualizar carrinho', 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showNotification('Erro ao atualizar carrinho', 'error');
        });
    }
}

function removeFromCart(productId) {
    if (confirm('Tem certeza que deseja remover este item do carrinho?')) {
        fetch('/gamestore/carrinho/remover', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`cart-item-${productId}`).remove();
                updateCartDisplay(data);
                showNotification('Item removido do carrinho', 'success');
            } else {
                showNotification(data.message || 'Erro ao remover item', 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showNotification('Erro ao remover item', 'error');
        });
    }
}

function updateCartDisplay(data) {
    // Atualiza o contador do carrinho no header
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        cartCount.textContent = data.cart_count;
    }
    
    // Atualiza os totais
    if (data.total !== undefined) {
        const subtotal = document.querySelector('.summary-item:first-child span:last-child');
        const total = document.querySelector('.summary-item.total span:last-child');
        if (subtotal) subtotal.textContent = `R$ ${formatPrice(data.total)}`;
        if (total) total.textContent = `R$ ${formatPrice(data.total)}`;
    }

}

function formatPrice(price) {
    return new Intl.NumberFormat('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(price);
}
</script> 