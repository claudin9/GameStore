// Função para atualizar o contador do carrinho
function updateCartCount(count) {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        cartCount.textContent = count;
    }
}

// Função para adicionar produto ao carrinho via AJAX
async function addToCart(productId) {
    try {
        const response = await fetch('/gamestore/carrinho/adicionar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1
            })
        });

        const data = await response.json();
        
        if (data.success) {
            updateCartCount(data.cart_count);
            showNotification('Produto adicionado ao carrinho!', 'success');
        } else {
            showNotification(data.message || 'Erro ao adicionar produto ao carrinho', 'error');
        }
    } catch (error) {
        console.error('Erro:', error);
        showNotification('Erro ao adicionar produto ao carrinho', 'error');
    }
}

// Função para mostrar notificações
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Remove a notificação após 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Função para formatar preço
function formatPrice(price) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(price);
}

// Função para validar formulário
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('error');
            isValid = false;
        } else {
            field.classList.remove('error');
        }
    });

    return isValid;
}

// Função para alternar menu mobile
function toggleMobileMenu() {
    const navMenu = document.querySelector('.nav-menu');
    if (navMenu) {
        navMenu.classList.toggle('active');
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    // Inicializar tooltips
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(element => {
        element.addEventListener('mouseenter', (e) => {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = e.target.dataset.tooltip;
            document.body.appendChild(tooltip);

            const rect = e.target.getBoundingClientRect();
            tooltip.style.top = `${rect.top - tooltip.offsetHeight - 5}px`;
            tooltip.style.left = `${rect.left + (rect.width - tooltip.offsetWidth) / 2}px`;
        });

        element.addEventListener('mouseleave', () => {
            const tooltip = document.querySelector('.tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });

    // Inicializar máscaras de input
    const inputs = document.querySelectorAll('input[data-mask]');
    inputs.forEach(input => {
        input.addEventListener('input', (e) => {
            const mask = e.target.dataset.mask;
            let value = e.target.value.replace(/\D/g, '');
            let result = '';

            for (let i = 0, j = 0; i < mask.length && j < value.length; i++) {
                if (mask[i] === '#') {
                    result += value[j];
                    j++;
                } else {
                    result += mask[i];
                }
            }

            e.target.value = result;
        });
    });
}); 