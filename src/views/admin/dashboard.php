<!-- Admin Header -->
<div class="admin-header">
    <div class="container">
        <h1 class="page-title">Painel Administrativo</h1>
    </div>
</div>

<!-- Admin Content -->
<div class="admin-content">
    <div class="container">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h3>Total de Vendas</h3>
                    <p class="stat-value">R$ <?= number_format($stats['total_sales'], 2, ',', '.') ?></p>
                    <p class="stat-change <?= $stats['sales_change'] >= 0 ? 'positive' : 'negative' ?>">
                        <?= $stats['sales_change'] >= 0 ? '+' : '' ?><?= number_format($stats['sales_change'], 1) ?>%
                        <span>vs mês anterior</span>
                    </p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>Total de Clientes</h3>
                    <p class="stat-value"><?= number_format($stats['total_customers']) ?></p>
                    <p class="stat-change <?= $stats['customers_change'] >= 0 ? 'positive' : 'negative' ?>">
                        <?= $stats['customers_change'] >= 0 ? '+' : '' ?><?= number_format($stats['customers_change'], 1) ?>%
                        <span>vs mês anterior</span>
                    </p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3>Pedidos Pendentes</h3>
                    <p class="stat-value"><?= number_format($stats['pending_orders']) ?></p>
                    <p class="stat-change <?= $stats['pending_change'] <= 0 ? 'positive' : 'negative' ?>">
                        <?= $stats['pending_change'] >= 0 ? '+' : '' ?><?= number_format($stats['pending_change'], 1) ?>%
                        <span>vs mês anterior</span>
                    </p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>Taxa de Conversão</h3>
                    <p class="stat-value"><?= number_format($stats['conversion_rate'], 1) ?>%</p>
                    <p class="stat-change <?= $stats['conversion_change'] >= 0 ? 'positive' : 'negative' ?>">
                        <?= $stats['conversion_change'] >= 0 ? '+' : '' ?><?= number_format($stats['conversion_change'], 1) ?>%
                        <span>vs mês anterior</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="charts-grid">
            <div class="chart-card">
                <h2>Vendas por Período</h2>
                <canvas id="salesChart"></canvas>
            </div>

            <div class="chart-card">
                <h2>Produtos Mais Vendidos</h2>
                <canvas id="productsChart"></canvas>
            </div>

            <div class="chart-card">
                <h2>Distribuição de Categorias</h2>
                <canvas id="categoriesChart"></canvas>
            </div>

            <div class="chart-card">
                <h2>Status dos Pedidos</h2>
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="recent-orders">
            <div class="section-header">
                <h2>Pedidos Recentes</h2>
                <a href="/gamestore/admin/pedidos" class="btn btn-outline">Ver Todos</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td>#<?= $order['id'] ?></td>
                                <td><?= $order['customer_name'] ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                <td>R$ <?= number_format($order['total_amount'], 2, ',', '.') ?></td>
                                <td>
                                    <span class="status-badge <?= $order['status'] ?>">
                                        <?= ucfirst($order['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="/gamestore/admin/pedidos/<?= $order['id'] ?>" 
                                           class="btn btn-icon" title="Ver Detalhes">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-icon" title="Atualizar Status"
                                                onclick="updateOrderStatus(<?= $order['id'] ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="low-stock">
            <div class="section-header">
                <h2>Produtos com Estoque Baixo</h2>
                <a href="/gamestore/admin/produtos" class="btn btn-outline">Ver Todos</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Estoque Atual</th>
                            <th>Estoque Mínimo</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lowStockProducts as $product): ?>
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>">
                                        <span><?= $product['name'] ?></span>
                                    </div>
                                </td>
                                <td><?= $product['category_name'] ?></td>
                                <td><?= $product['stock'] ?></td>
                                <td><?= $product['min_stock'] ?></td>
                                <td>
                                    <span class="status-badge <?= $product['stock'] <= 0 ? 'out-of-stock' : 'low-stock' ?>">
                                        <?= $product['stock'] <= 0 ? 'Sem Estoque' : 'Estoque Baixo' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="/gamestore/admin/produtos/<?= $product['id'] ?>/editar" 
                                           class="btn btn-icon" title="Editar Produto">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-icon" title="Ajustar Estoque"
                                                onclick="adjustStock(<?= $product['id'] ?>)">
                                            <i class="fas fa-boxes"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: <?= json_encode($stats['sales_labels']) ?>,
            datasets: [{
                label: 'Vendas',
                data: <?= json_encode($stats['sales_data']) ?>,
                borderColor: '#6c5ce7',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(108, 92, 231, 0.1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'R$ ' + value.toLocaleString('pt-BR');
                        }
                    }
                }
            }
        }
    });

    // Products Chart
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    new Chart(productsCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($stats['top_products_labels']) ?>,
            datasets: [{
                label: 'Quantidade Vendida',
                data: <?= json_encode($stats['top_products_data']) ?>,
                backgroundColor: '#6c5ce7'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Categories Chart
    const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
    new Chart(categoriesCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($stats['categories_labels']) ?>,
            datasets: [{
                data: <?= json_encode($stats['categories_data']) ?>,
                backgroundColor: [
                    '#6c5ce7',
                    '#a8a4e6',
                    '#00b894',
                    '#00cec9',
                    '#0984e3'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($stats['orders_labels']) ?>,
            datasets: [{
                data: <?= json_encode($stats['orders_data']) ?>,
                backgroundColor: [
                    '#6c5ce7',
                    '#00b894',
                    '#fdcb6e',
                    '#d63031',
                    '#b2bec3'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });
});

// Order status update
function updateOrderStatus(orderId) {
    const statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
    const currentStatus = document.querySelector(`tr[data-order-id="${orderId}"] .status-badge`).textContent.toLowerCase();
    
    const newStatus = prompt('Novo status do pedido:', currentStatus);
    if (newStatus && statuses.includes(newStatus.toLowerCase())) {
        fetch(`/gamestore/admin/pedidos/${orderId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                status: newStatus.toLowerCase()
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                showNotification(data.message || 'Erro ao atualizar status', 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showNotification('Erro ao atualizar status', 'error');
        });
    }
}

// Stock adjustment
function adjustStock(productId) {
    const newStock = prompt('Nova quantidade em estoque:');
    if (newStock !== null && !isNaN(newStock)) {
        fetch(`/gamestore/admin/produtos/${productId}/estoque`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                stock: parseInt(newStock)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                showNotification(data.message || 'Erro ao ajustar estoque', 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showNotification('Erro ao ajustar estoque', 'error');
        });
    }
}
</script> 