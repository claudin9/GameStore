<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore - Sua Loja de Games</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #7952b3;
            --secondary-color: #61428f;
        }

        .navbar-custom {
            background: linear-gradient(to right, #4a148c, #7b1fa2);
        }

        .btn-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }

        .card-game {
            transition: transform 0.2s;
        }

        .card-game:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 3rem 0;
        }

        /* Cart Dropdown Styles */
        .cart-dropdown {
            width: 350px;
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 0;
            margin-top: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-dropdown .dropdown-header {
            background: #f8f9fa;
            padding: 12px 15px;
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-items {
            max-height: 300px;
            overflow-y: auto;
            padding: 0;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            background: white;
        }

        .cart-item:hover {
            background: #f8f9fa;
        }

        .cart-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 1px solid #dee2e6;
            margin-right: 15px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-title {
            font-size: 0.9rem;
            margin-bottom: 2px;
            color: #333;
        }

        .cart-item-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
        }

        .cart-item-price {
            color: #28a745;
            font-weight: 500;
        }

        .cart-item-quantity {
            color: #666;
        }

        .cart-item-remove {
            color: #dc3545;
            background: none;
            border: none;
            padding: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .cart-summary {
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-actions {
            background: white;
            padding: 10px 15px;
        }

        .empty-cart-message {
            padding: 20px;
            text-align: center;
            color: #666;
        }

        /* Estilos do Carrinho */
        .dropdown-menu {
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            padding: 1rem;
            margin-top: 0.5rem;
            min-width: 320px !important;
        }

        #cart-dropdown {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
            border-radius: 8px;
            overflow: hidden;
        }

        .cart-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            padding: 0.75rem;
        }

        .cart-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .cart-item img {
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .cart-item h6 {
            color: white;
            font-size: 0.9rem;
            margin: 0;
        }

        .cart-item small {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }

        .cart-total {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        #cart-count {
            font-size: 0.7rem;
            transform: translate(-50%, -50%);
        }

        .toast {
            background: rgba(40, 167, 69, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .toast.bg-danger {
            background: rgba(220, 53, 69, 0.9) !important;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
            background: transparent;
        }

        .btn-outline-danger:hover {
            color: white;
            background: #dc3545;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/gamestore">
                <i class="fas fa-gamepad"></i> GameStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/products">Produtos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/contact">Contato</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="cartDropdownToggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                                0
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-dark border-light" id="cart-dropdown" style="min-width: 300px; max-height: 400px; overflow-y: auto;">
                            <p class="text-center text-muted my-3">Carrinho vazio</p>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gamestore/login">
                            <i class="fas fa-user"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-4">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre a GameStore</h5>
                    <p>Sua loja especializada em games, oferecendo os melhores produtos para gamers.</p>
                </div>
                <div class="col-md-4">
                    <h5>Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li><a href="/gamestore/about" class="text-white">Sobre Nós</a></li>
                        <li><a href="/gamestore/privacy" class="text-white">Política de Privacidade</a></li>
                        <li><a href="/gamestore/terms" class="text-white">Termos de Uso</a></li>
                        <li><a href="/gamestore/faq" class="text-white">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope"></i> contato@gamestore.com</li>
                        <li><i class="fas fa-phone"></i> (11) 1234-5678</li>
                        <li><i class="fas fa-map-marker-alt"></i> São Paulo, SP</li>
                    </ul>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 bg-light">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 GameStore. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Funções do Carrinho
    function updateCartDropdown() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartDropdown = document.getElementById('cart-dropdown');
        const cartCount = document.getElementById('cart-count');
        
        // Atualiza o contador
        const totalItems = cart.reduce((total, item) => total + parseInt(item.quantity), 0);
        if (cartCount) {
            cartCount.textContent = totalItems;
            cartCount.style.display = totalItems > 0 ? 'block' : 'none';
        }
        
        // Atualiza o conteúdo do dropdown
        if (!cartDropdown) return;
        
        let total = 0;
        let cartHtml = '';
        
        if (cart.length === 0) {
            cartHtml = '<p class="text-center text-white-50 my-3">Carrinho vazio</p>';
        } else {
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                cartHtml += `
                    <div class="cart-item d-flex align-items-center gap-2 p-2">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image" style="width: 50px; height: 50px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <h6 class="mb-0 text-white">${item.name}</h6>
                            <small class="text-white-50">Qtd: ${item.quantity} x R$ ${item.price.toFixed(2)}</small>
                        </div>
                        <button onclick="removeFromCart(${index})" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
            });
            
            cartHtml += `
                <div class="cart-total p-3 mt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <strong class="text-white">Total:</strong>
                        <span class="text-white">R$ ${total.toFixed(2)}</span>
                    </div>
                    <div class="d-grid gap-2">
                        <button onclick="checkout()" class="btn btn-primary btn-sm">Finalizar Compra</button>
                        <button onclick="clearCart()" class="btn btn-outline-danger btn-sm">Limpar Carrinho</button>
                    </div>
                </div>
            `;
        }
        
        cartDropdown.innerHTML = cartHtml;
    }

    function addToCart(name, price, image, quantity = 1) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Verifica se o produto já está no carrinho
        const existingItemIndex = cart.findIndex(item => item.name === name);
        
        if (existingItemIndex > -1) {
            cart[existingItemIndex].quantity = parseInt(cart[existingItemIndex].quantity) + parseInt(quantity);
        } else {
            cart.push({
                name: name,
                price: parseFloat(price),
                image: image,
                quantity: parseInt(quantity)
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Atualiza o dropdown e mostra notificação
        updateCartDropdown();
        showNotification('Produto adicionado ao carrinho!');
    }

    function removeFromCart(index) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDropdown();
        showNotification('Produto removido do carrinho!');
    }

    function clearCart() {
        localStorage.removeItem('cart');
        updateCartDropdown();
        showNotification('Carrinho limpo!');
    }

    function checkout() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length === 0) {
            showNotification('Seu carrinho está vazio!', 'danger');
            return;
        }
        
        // Aqui você pode adicionar a lógica de checkout
        alert('Compra finalizada com sucesso!');
        clearCart();
    }

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = 'position-fixed top-0 end-0 p-3';
        notification.style.zIndex = '9999';
        
        notification.innerHTML = `
            <div class="toast show bg-${type} text-white" role="alert">
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Inicializa o carrinho quando a página carrega
    document.addEventListener('DOMContentLoaded', () => {
        updateCartDropdown();
    });
    </script>
</body>
</html> 