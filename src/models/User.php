<?php

namespace App\Models;

class User extends Model {
    protected $table = 'users';

    public function findByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        $stmt = $this->db->query($sql, [$email]);
        return $stmt->fetch();
    }

    public function create(array $data) {
        // Hash da senha antes de salvar
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return parent::create($data);
    }

    public function update($id, array $data) {
        // Se uma nova senha foi fornecida, hash ela
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return parent::update($id, $data);
    }

    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function getOrders($userId) {
        $sql = "SELECT o.*, 
                COUNT(oi.id) as total_items,
                SUM(oi.quantity * oi.price) as total_amount
                FROM orders o
                LEFT JOIN order_items oi ON o.id = oi.order_id
                WHERE o.user_id = ?
                GROUP BY o.id
                ORDER BY o.created_at DESC";
        
        $stmt = $this->db->query($sql, [$userId]);
        return $stmt->fetchAll();
    }

    public function getOrderDetails($userId, $orderId) {
        $sql = "SELECT o.*, oi.*, p.name as product_name, p.image_url
                FROM orders o
                JOIN order_items oi ON o.id = oi.order_id
                JOIN products p ON oi.product_id = p.id
                WHERE o.user_id = ? AND o.id = ?";
        
        $stmt = $this->db->query($sql, [$userId, $orderId]);
        return $stmt->fetchAll();
    }

    public function getCartItems($userId) {
        $sql = "SELECT ci.*, p.name, p.price, p.image_url
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                WHERE ci.user_id = ?";
        
        $stmt = $this->db->query($sql, [$userId]);
        return $stmt->fetchAll();
    }

    public function addToCart($userId, $productId, $quantity = 1) {
        // Verifica se o item já existe no carrinho
        $sql = "SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?";
        $stmt = $this->db->query($sql, [$userId, $productId]);
        $existingItem = $stmt->fetch();

        if ($existingItem) {
            // Atualiza a quantidade
            $sql = "UPDATE cart_items SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
            return $this->db->query($sql, [$quantity, $userId, $productId]);
        } else {
            // Adiciona novo item
            return $this->db->insert('cart_items', [
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
    }

    public function updateCartItem($userId, $productId, $quantity) {
        if ($quantity <= 0) {
            // Remove o item se a quantidade for 0 ou menor
            return $this->db->delete('cart_items', 'user_id = ? AND product_id = ?', [$userId, $productId]);
        } else {
            // Atualiza a quantidade
            $sql = "UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?";
            return $this->db->query($sql, [$quantity, $userId, $productId]);
        }
    }

    public function removeFromCart($userId, $productId) {
        return $this->db->delete('cart_items', 'user_id = ? AND product_id = ?', [$userId, $productId]);
    }

    public function clearCart($userId) {
        return $this->db->delete('cart_items', 'user_id = ?', [$userId]);
    }

    public function getCartTotal($userId) {
        $sql = "SELECT SUM(ci.quantity * p.price) as total
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                WHERE ci.user_id = ?";
        
        $stmt = $this->db->query($sql, [$userId]);
        return $stmt->fetch()['total'] ?? 0;
    }

    public function getReviews($userId) {
        $sql = "SELECT r.*, p.name as product_name, p.image_url
                FROM reviews r
                JOIN products p ON r.product_id = p.id
                WHERE r.user_id = ?
                ORDER BY r.created_at DESC";
        
        $stmt = $this->db->query($sql, [$userId]);
        return $stmt->fetchAll();
    }
} 