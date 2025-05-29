<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller {
    private $userModel;
    private $productModel;
    private $orderModel;

    public function __construct() {
        $this->userModel = new User();
        $this->productModel = new Product();
        $this->orderModel = new Order();
    }

    public function index() {
        $this->requireAuth();

        $cartItems = $this->userModel->getCartItems($_SESSION['user_id']);
        $total = $this->userModel->getCartTotal($_SESSION['user_id']);

        $this->view('cart/index', [
            'title' => 'Carrinho - GameStore',
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function add() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id']);
            $quantity = intval($_POST['quantity'] ?? 1);

            $product = $this->productModel->find($productId);
            
            if (!$product) {
                $this->json([
                    'success' => false,
                    'message' => 'Produto não encontrado.'
                ], 404);
            }

            if ($product['stock'] < $quantity) {
                $this->json([
                    'success' => false,
                    'message' => 'Quantidade indisponível em estoque.'
                ], 400);
            }

            if ($this->userModel->addToCart($_SESSION['user_id'], $productId, $quantity)) {
                $cartCount = $this->userModel->getCartCount($_SESSION['user_id']);
                
                $this->json([
                    'success' => true,
                    'message' => 'Produto adicionado ao carrinho!',
                    'cart_count' => $cartCount
                ]);
            } else {
                $this->json([
                    'success' => false,
                    'message' => 'Erro ao adicionar produto ao carrinho.'
                ], 500);
            }
        }

        $this->redirect('/gamestore/carrinho');
    }

    public function update() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id']);
            $quantity = intval($_POST['quantity']);

            if ($quantity <= 0) {
                $this->userModel->removeFromCart($_SESSION['user_id'], $productId);
            } else {
                $product = $this->productModel->find($productId);
                
                if (!$product) {
                    $this->json([
                        'success' => false,
                        'message' => 'Produto não encontrado.'
                    ], 404);
                }

                if ($product['stock'] < $quantity) {
                    $this->json([
                        'success' => false,
                        'message' => 'Quantidade indisponível em estoque.'
                    ], 400);
                }

                $this->userModel->updateCartItem($_SESSION['user_id'], $productId, $quantity);
            }

            $cartItems = $this->userModel->getCartItems($_SESSION['user_id']);
            $total = $this->userModel->getCartTotal($_SESSION['user_id']);
            $cartCount = $this->userModel->getCartCount($_SESSION['user_id']);

            $this->json([
                'success' => true,
                'cart_items' => $cartItems,
                'total' => $total,
                'cart_count' => $cartCount
            ]);
        }

        $this->redirect('/gamestore/carrinho');
    }

    public function remove() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id']);

            if ($this->userModel->removeFromCart($_SESSION['user_id'], $productId)) {
                $cartItems = $this->userModel->getCartItems($_SESSION['user_id']);
                $total = $this->userModel->getCartTotal($_SESSION['user_id']);
                $cartCount = $this->userModel->getCartCount($_SESSION['user_id']);

                $this->json([
                    'success' => true,
                    'message' => 'Produto removido do carrinho!',
                    'cart_items' => $cartItems,
                    'total' => $total,
                    'cart_count' => $cartCount
                ]);
            } else {
                $this->json([
                    'success' => false,
                    'message' => 'Erro ao remover produto do carrinho.'
                ], 500);
            }
        }

        $this->redirect('/gamestore/carrinho');
    }

    public function clear() {
        $this->requireAuth();

        if ($this->userModel->clearCart($_SESSION['user_id'])) {
            $this->setFlashMessage('Carrinho limpo com sucesso!', 'success');
        } else {
            $this->setFlashMessage('Erro ao limpar carrinho.', 'error');
        }

        $this->redirect('/gamestore/carrinho');
    }

    public function checkout() {
        $this->requireAuth();

        $cartItems = $this->userModel->getCartItems($_SESSION['user_id']);
        $total = $this->userModel->getCartTotal($_SESSION['user_id']);
        $user = $this->userModel->find($_SESSION['user_id']);

        if (empty($cartItems)) {
            $this->setFlashMessage('Seu carrinho está vazio.', 'error');
            $this->redirect('/gamestore/carrinho');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'payment_method' => 'required',
                'shipping_address' => 'required|min:10'
            ];

            $errors = $this->validateRequest($rules);

            if (empty($errors)) {
                try {
                    $orderData = [
                        'user_id' => $_SESSION['user_id'],
                        'total_amount' => $total,
                        'payment_method' => $this->sanitizeInput($_POST['payment_method']),
                        'shipping_address' => $this->sanitizeInput($_POST['shipping_address']),
                        'items' => $cartItems
                    ];

                    $orderId = $this->orderModel->create($orderData);

                    if ($orderId) {
                        // Limpa o carrinho após criar o pedido
                        $this->userModel->clearCart($_SESSION['user_id']);
                        
                        $this->setFlashMessage('Pedido realizado com sucesso!', 'success');
                        $this->redirect("/gamestore/pedidos/{$orderId}");
                    } else {
                        $this->setFlashMessage('Erro ao processar pedido.', 'error');
                    }
                } catch (\Exception $e) {
                    $this->setFlashMessage('Erro ao processar pedido: ' . $e->getMessage(), 'error');
                }
            }
        }

        $this->view('cart/checkout', [
            'title' => 'Finalizar Compra - GameStore',
            'cartItems' => $cartItems,
            'total' => $total,
            'user' => $user,
            'errors' => $errors ?? []
        ]);
    }
} 