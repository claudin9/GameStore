<?php

namespace App\Models;

class Product extends Model {
    protected $table = 'products';

    public function getByCategory($categoryId, $page = 1, $perPage = 12) {
        $offset = ($page - 1) * $perPage;
        
        // Get total records
        $totalSql = "SELECT COUNT(*) as total FROM {$this->table} WHERE category_id = ?";
        $stmt = $this->db->prepare($totalSql);
        $stmt->execute([$categoryId]);
        $total = $stmt->fetch()['total'];
        
        // Get paginated records
        $sql = "SELECT p.*, c.name as category_name 
                FROM {$this->table} p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.category_id = ? 
                ORDER BY p.created_at DESC 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId, $perPage, $offset]);
        
        return [
            'data' => $stmt->fetchAll(),
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage)
        ];
    }

    public function search($query, $page = 1, $perPage = 12) {
        $offset = ($page - 1) * $perPage;
        $searchQuery = "%{$query}%";
        
        // Get total records
        $totalSql = "SELECT COUNT(*) as total FROM {$this->table} 
                     WHERE name LIKE ? OR description LIKE ?";
        $stmt = $this->db->prepare($totalSql);
        $stmt->execute([$searchQuery, $searchQuery]);
        $total = $stmt->fetch()['total'];
        
        // Get paginated records
        $sql = "SELECT p.*, c.name as category_name 
                FROM {$this->table} p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE ? OR p.description LIKE ? 
                ORDER BY p.created_at DESC 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$searchQuery, $searchQuery, $perPage, $offset]);
        
        return [
            'data' => $stmt->fetchAll(),
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage)
        ];
    }

    public function getFeatured($limit = 8) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM {$this->table} p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.created_at DESC 
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function getRelated($productId, $categoryId, $limit = 4) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM {$this->table} p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.category_id = ? AND p.id != ? 
                ORDER BY p.created_at DESC 
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId, $productId, $limit]);
        return $stmt->fetchAll();
    }

    public function updateStock($productId, $quantity, $operation = 'decrease') {
        $sql = "UPDATE {$this->table} 
                SET stock = stock " . ($operation === 'decrease' ? '-' : '+') . " ? 
                WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $productId]);
    }

    public function getReviews($productId) {
        $sql = "SELECT r.*, u.name as user_name 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id 
                WHERE r.product_id = ? 
                ORDER BY r.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetchAll();
    }

    public function getAverageRating($productId) {
        $sql = "SELECT AVG(rating) as average_rating, COUNT(*) as total_reviews 
                FROM reviews 
                WHERE product_id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch();
    }
} 