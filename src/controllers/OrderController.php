<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\User;

class OrderController extends Controller {
    private $orderModel;
    private $userModel;

    public function __construct() {
        $this->orderModel = new Order();
        $this->userModel = new User();
    }

    public function index() {
        $this->requireAuth();

        $orders = $this->userModel->getOrders($_SESSION['user_id']);

        $this->view('orders/index', [
            'title' => 'Meus Pedidos - GameStore',
            'orders' => $orders
        ]);
    }

    public function show($id) {
        $this->requireAuth();

        $order = $this->orderModel->getOrderWithItems($id);
        
        if (!$order) {
            $this->setFlashMessage('Pedido não encontrado.', 'error');
            $this->redirect('/gamestore/pedidos');
        }

        // Verifica se o pedido pertence ao usuário logado
        if ($order[0]['user_id'] !== $_SESSION['user_id'] && !$this->isAdmin()) {
            $this->setFlashMessage('Você não tem permissão para ver este pedido.', 'error');
            $this->redirect('/gamestore/pedidos');
        }

        $this->view('orders/show', [
            'title' => "Pedido #{$id} - GameStore",
            'order' => $order[0],
            'items' => array_slice($order, 1)
        ]);
    }

    public function admin() {
        $this->requireAdmin();

        $status = $_GET['status'] ?? null;
        $page = $_GET['page'] ?? 1;

        if ($status) {
            $result = $this->orderModel->getOrdersByStatus($status, $page);
        } else {
            $result = $this->orderModel->paginate($page);
        }

        $this->view('admin/orders/index', [
            'title' => 'Gerenciar Pedidos - GameStore',
            'orders' => $result['data'],
            'pagination' => [
                'current_page' => $result['current_page'],
                'last_page' => $result['last_page'],
                'total' => $result['total']
            ]
        ]);
    }

    public function updateStatus() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = intval($_POST['order_id']);
            $status = $this->sanitizeInput($_POST['status']);

            if ($this->orderModel->updateStatus($orderId, $status)) {
                $this->setFlashMessage('Status do pedido atualizado com sucesso!', 'success');
            } else {
                $this->setFlashMessage('Erro ao atualizar status do pedido.', 'error');
            }
        }

        $this->redirect('/gamestore/admin/pedidos');
    }

    public function dashboard() {
        $this->requireAdmin();

        $stats = $this->orderModel->getOrderStats();
        $recentOrders = $this->orderModel->getRecentOrders();

        $this->view('admin/dashboard', [
            'title' => 'Dashboard - GameStore',
            'stats' => $stats,
            'recentOrders' => $recentOrders
        ]);
    }

    public function report() {
        $this->requireAdmin();

        $startDate = $_GET['start_date'] ?? date('Y-m-01');
        $endDate = $_GET['end_date'] ?? date('Y-m-t');

        $orders = $this->orderModel->getOrdersByDateRange($startDate, $endDate);

        $this->view('admin/orders/report', [
            'title' => 'Relatório de Pedidos - GameStore',
            'orders' => $orders,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function invoice($id) {
        $this->requireAuth();

        $order = $this->orderModel->getOrderWithItems($id);
        
        if (!$order) {
            $this->setFlashMessage('Pedido não encontrado.', 'error');
            $this->redirect('/gamestore/pedidos');
        }

        // Verifica se o pedido pertence ao usuário logado
        if ($order[0]['user_id'] !== $_SESSION['user_id'] && !$this->isAdmin()) {
            $this->setFlashMessage('Você não tem permissão para ver este pedido.', 'error');
            $this->redirect('/gamestore/pedidos');
        }

        $this->view('orders/invoice', [
            'title' => "Nota Fiscal #{$id} - GameStore",
            'order' => $order[0],
            'items' => array_slice($order, 1)
        ]);
    }

    public function cancel($id) {
        $this->requireAuth();

        $order = $this->orderModel->find($id);
        
        if (!$order) {
            $this->setFlashMessage('Pedido não encontrado.', 'error');
            $this->redirect('/gamestore/pedidos');
        }

        // Verifica se o pedido pertence ao usuário logado
        if ($order['user_id'] !== $_SESSION['user_id'] && !$this->isAdmin()) {
            $this->setFlashMessage('Você não tem permissão para cancelar este pedido.', 'error');
            $this->redirect('/gamestore/pedidos');
        }

        // Verifica se o pedido pode ser cancelado
        if (!in_array($order['status'], ['pending', 'processing'])) {
            $this->setFlashMessage('Este pedido não pode ser cancelado.', 'error');
            $this->redirect('/gamestore/pedidos');
        }

        if ($this->orderModel->updateStatus($id, 'cancelled')) {
            $this->setFlashMessage('Pedido cancelado com sucesso!', 'success');
        } else {
            $this->setFlashMessage('Erro ao cancelar pedido.', 'error');
        }

        $this->redirect('/gamestore/pedidos');
    }
} 