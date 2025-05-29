<!-- Profile Header -->
<div class="profile-header">
    <div class="container">
        <h1 class="page-title">Meu Perfil</h1>
    </div>
</div>

<!-- Profile Content -->
<div class="profile-content">
    <div class="container">
        <div class="profile-layout">
            <!-- Profile Sidebar -->
            <aside class="profile-sidebar">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="<?= $user['avatar_url'] ?? '/gamestore/assets/images/default-avatar.png' ?>" 
                             alt="<?= $user['name'] ?>">
                        <button class="btn btn-icon" onclick="document.getElementById('avatarInput').click()">
                            <i class="fas fa-camera"></i>
                        </button>
                        <input type="file" id="avatarInput" accept="image/*" style="display: none" 
                               onchange="updateAvatar(this)">
                    </div>
                    <h2><?= $user['name'] ?></h2>
                    <p><?= $user['email'] ?></p>
                </div>

                <nav class="profile-nav">
                    <a href="#personal" class="active" data-tab="personal">
                        <i class="fas fa-user"></i> Dados Pessoais
                    </a>
                    <a href="#orders" data-tab="orders">
                        <i class="fas fa-shopping-bag"></i> Meus Pedidos
                    </a>
                    <a href="#addresses" data-tab="addresses">
                        <i class="fas fa-map-marker-alt"></i> Endereços
                    </a>
                    <a href="#reviews" data-tab="reviews">
                        <i class="fas fa-star"></i> Minhas Avaliações
                    </a>
                    <a href="#wishlist" data-tab="wishlist">
                        <i class="fas fa-heart"></i> Lista de Desejos
                    </a>
                    <a href="#security" data-tab="security">
                        <i class="fas fa-shield-alt"></i> Segurança
                    </a>
                    <a href="/gamestore/logout" class="logout">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </nav>
            </aside>

            <!-- Profile Main Content -->
            <main class="profile-main">
                <!-- Personal Information -->
                <section id="personal" class="profile-section active">
                    <h2>Dados Pessoais</h2>
                    <form action="/gamestore/perfil/atualizar" method="POST" class="profile-form">
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" name="name" value="<?= $user['name'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" value="<?= $user['email'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" name="cpf" value="<?= $user['cpf'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="tel" name="phone" value="<?= $user['phone'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Endereço</label>
                            <textarea name="address" rows="3"><?= $user['address'] ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </section>

                <!-- Orders -->
                <section id="orders" class="profile-section">
                    <h2>Meus Pedidos</h2>
                    <?php if (empty($orders)): ?>
                        <div class="empty-state">
                            <i class="fas fa-shopping-bag"></i>
                            <p>Você ainda não fez nenhum pedido.</p>
                            <a href="/gamestore/produtos" class="btn btn-primary">Ver Produtos</a>
                        </div>
                    <?php else: ?>
                        <div class="orders-list">
                            <?php foreach ($orders as $order): ?>
                                <div class="order-card">
                                    <div class="order-header">
                                        <div class="order-info">
                                            <h3>Pedido #<?= $order['id'] ?></h3>
                                            <p>Data: <?= date('d/m/Y', strtotime($order['created_at'])) ?></p>
                                        </div>
                                        <div class="order-status <?= $order['status'] ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </div>
                                    </div>
                                    <div class="order-items">
                                        <?php foreach ($order['items'] as $item): ?>
                                            <div class="order-item">
                                                <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>">
                                                <div class="item-info">
                                                    <h4><?= $item['name'] ?></h4>
                                                    <p>Quantidade: <?= $item['quantity'] ?></p>
                                                    <p>R$ <?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="order-footer">
                                        <div class="order-total">
                                            <span>Total:</span>
                                            <span>R$ <?= number_format($order['total_amount'], 2, ',', '.') ?></span>
                                        </div>
                                        <div class="order-actions">
                                            <a href="/gamestore/pedidos/<?= $order['id'] ?>" class="btn btn-outline">
                                                Ver Detalhes
                                            </a>
                                            <?php if ($order['status'] === 'pending'): ?>
                                                <button class="btn btn-danger" 
                                                        onclick="cancelOrder(<?= $order['id'] ?>)">
                                                    Cancelar Pedido
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Addresses -->
                <section id="addresses" class="profile-section">
                    <h2>Meus Endereços</h2>
                    <div class="addresses-list">
                        <?php foreach ($addresses as $address): ?>
                            <div class="address-card">
                                <div class="address-header">
                                    <h3><?= $address['name'] ?></h3>
                                    <div class="address-actions">
                                        <button class="btn btn-icon" onclick="editAddress(<?= $address['id'] ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-icon" onclick="deleteAddress(<?= $address['id'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="address-content">
                                    <p><?= $address['street'] ?>, <?= $address['number'] ?></p>
                                    <?php if ($address['complement']): ?>
                                        <p><?= $address['complement'] ?></p>
                                    <?php endif; ?>
                                    <p><?= $address['neighborhood'] ?></p>
                                    <p><?= $address['city'] ?> - <?= $address['state'] ?></p>
                                    <p>CEP: <?= $address['zipcode'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="btn btn-primary" onclick="showAddressForm()">
                        Adicionar Novo Endereço
                    </button>
                </section>

                <!-- Reviews -->
                <section id="reviews" class="profile-section">
                    <h2>Minhas Avaliações</h2>
                    <?php if (empty($reviews)): ?>
                        <div class="empty-state">
                            <i class="fas fa-star"></i>
                            <p>Você ainda não fez nenhuma avaliação.</p>
                        </div>
                    <?php else: ?>
                        <div class="reviews-list">
                            <?php foreach ($reviews as $review): ?>
                                <div class="review-card">
                                    <div class="review-header">
                                        <img src="<?= $review['product_image'] ?>" alt="<?= $review['product_name'] ?>">
                                        <div class="review-info">
                                            <h3><?= $review['product_name'] ?></h3>
                                            <div class="review-rating">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star <?= $i <= $review['rating'] ? 'active' : '' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <p class="review-date">
                                                <?= date('d/m/Y', strtotime($review['created_at'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="review-content">
                                        <?= nl2br($review['comment']) ?>
                                    </div>
                                    <?php if (!empty($review['images'])): ?>
                                        <div class="review-images">
                                            <?php foreach (json_decode($review['images']) as $image): ?>
                                                <img src="<?= $image ?>" alt="Review image">
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Wishlist -->
                <section id="wishlist" class="profile-section">
                    <h2>Lista de Desejos</h2>
                    <?php if (empty($wishlist)): ?>
                        <div class="empty-state">
                            <i class="fas fa-heart"></i>
                            <p>Sua lista de desejos está vazia.</p>
                            <a href="/gamestore/produtos" class="btn btn-primary">Ver Produtos</a>
                        </div>
                    <?php else: ?>
                        <div class="products-grid">
                            <?php foreach ($wishlist as $product): ?>
                                <div class="product-card">
                                    <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>" class="product-image">
                                    <div class="product-info">
                                        <h3 class="product-title"><?= $product['name'] ?></h3>
                                        <p class="product-category"><?= $product['category_name'] ?></p>
                                        <p class="product-price">R$ <?= number_format($product['price'], 2, ',', '.') ?></p>
                                        <div class="product-actions">
                                            <button class="btn btn-primary" onclick="addToCart(<?= $product['id'] ?>)">
                                                Adicionar ao Carrinho
                                            </button>
                                            <button class="btn btn-icon" onclick="removeFromWishlist(<?= $product['id'] ?>)">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Security -->
                <section id="security" class="profile-section">
                    <h2>Segurança</h2>
                    <form action="/gamestore/perfil/senha" method="POST" class="security-form">
                        <div class="form-group">
                            <label>Senha Atual</label>
                            <div class="password-input">
                                <input type="password" name="current_password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nova Senha</label>
                            <div class="password-input">
                                <input type="password" name="new_password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bar"></div>
                                <span class="strength-text">Força da senha: <span>Fraca</span></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Confirmar Nova Senha</label>
                            <div class="password-input">
                                <input type="password" name="confirm_password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Alterar Senha</button>
                    </form>

                    <div class="security-options">
                        <h3>Autenticação em Duas Etapas</h3>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="two_factor" <?= $user['two_factor_enabled'] ? 'checked' : '' ?>>
                                Ativar autenticação em duas etapas
                            </label>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab navigation
    const tabs = document.querySelectorAll('.profile-nav a[data-tab]');
    const sections = document.querySelectorAll('.profile-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const targetTab = this.getAttribute('data-tab');

            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Show target section
            sections.forEach(section => {
                section.classList.remove('active');
                if (section.id === targetTab) {
                    section.classList.add('active');
                }
            });
        });
    });

    // Toggle password visibility
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });

    // Password strength checker
    const passwordInput = document.querySelector('input[name="new_password"]');
    if (passwordInput) {
        const strengthBar = document.querySelector('.strength-bar');
        const strengthText = document.querySelector('.strength-text span');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let strengthLabel = 'Fraca';

            // Length check
            if (password.length >= 8) strength += 25;

            // Contains number
            if (/\d/.test(password)) strength += 25;

            // Contains letter
            if (/[a-zA-Z]/.test(password)) strength += 25;

            // Contains special character
            if (/[^A-Za-z0-9]/.test(password)) strength += 25;

            // Update strength bar
            strengthBar.style.width = `${strength}%`;
            strengthBar.className = 'strength-bar';

            // Update strength text
            if (strength >= 75) {
                strengthLabel = 'Forte';
                strengthBar.classList.add('strong');
            } else if (strength >= 50) {
                strengthLabel = 'Média';
                strengthBar.classList.add('medium');
            } else {
                strengthLabel = 'Fraca';
                strengthBar.classList.add('weak');
            }

            strengthText.textContent = strengthLabel;
        });
    }

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const password = form.querySelector('input[name="new_password"]');
            const confirmPassword = form.querySelector('input[name="confirm_password"]');

            if (password && confirmPassword && password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('As senhas não coincidem!');
            }
        });
    });
});

// Avatar upload
function updateAvatar(input) {
    if (input.files && input.files[0]) {
        const formData = new FormData();
        formData.append('avatar', input.files[0]);

        fetch('/gamestore/perfil/avatar', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.user-avatar img').src = data.avatar_url;
                showNotification('Avatar atualizado com sucesso!', 'success');
            } else {
                showNotification(data.message || 'Erro ao atualizar avatar', 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showNotification('Erro ao atualizar avatar', 'error');
        });
    }
}

// Order cancellation
function cancelOrder(orderId) {
    if (confirm('Tem certeza que deseja cancelar este pedido?')) {
        fetch(`/gamestore/pedidos/${orderId}/cancelar`, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                showNotification(data.message || 'Erro ao cancelar pedido', 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showNotification('Erro ao cancelar pedido', 'error');
        });
    }
}

// Address management
function showAddressForm() {
    // Implementar modal de endereço
    alert('Funcionalidade em desenvolvimento!');
}

function editAddress(addressId) {
    // Implementar edição de endereço
    alert('Funcionalidade em desenvolvimento!');
}

function deleteAddress(addressId) {
    if (confirm('Tem certeza que deseja excluir este endereço?')) {
        fetch(`/gamestore/enderecos/${addressId}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                showNotification(data.message || 'Erro ao excluir endereço', 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showNotification('Erro ao excluir endereço', 'error');
        });
    }
}

// Wishlist management
function removeFromWishlist(productId) {
    fetch(`/gamestore/favoritos/${productId}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            showNotification(data.message || 'Erro ao remover da lista de desejos', 'error');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('Erro ao remover da lista de desejos', 'error');
    });
}
</script> 