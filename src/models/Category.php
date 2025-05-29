<?php

namespace App\Models;

class Category extends Model {
    protected $table = 'categories';

    public function getProducts($categoryId, $page = 1, $perPage = 12) {
        $offset = ($page - 1) * $perPage;
        
        // Get total records
        $totalSql = "SELECT COUNT(*) as total FROM products WHERE category_id = ?";
        $totalStmt = $this->db->query($totalSql, [$categoryId]);
        $total = $totalStmt->fetch()['total'];
        
        // Get paginated records
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.category_id = ? 
                ORDER BY p.created_at DESC 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->query($sql, [$categoryId, $perPage, $offset]);
        
        return [
            'data' => $stmt->fetchAll(),
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage)
        ];
    }

    public function getParentCategories() {
        $sql = "SELECT * FROM {$this->table} WHERE parent_id IS NULL ORDER BY name";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getSubCategories($parentId) {
        $sql = "SELECT * FROM {$this->table} WHERE parent_id = ? ORDER BY name";
        $stmt = $this->db->query($sql, [$parentId]);
        return $stmt->fetchAll();
    }

    public function getCategoryTree() {
        $categories = $this->all();
        $tree = [];
        
        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $tree[$category['id']] = [
                    'category' => $category,
                    'children' => []
                ];
            } else {
                if (isset($tree[$category['parent_id']])) {
                    $tree[$category['parent_id']]['children'][] = $category;
                }
            }
        }
        
        return $tree;
    }

    public function getCategoryWithProducts($categoryId) {
        $sql = "SELECT c.*, 
                COUNT(p.id) as total_products,
                MIN(p.price) as min_price,
                MAX(p.price) as max_price
                FROM categories c
                LEFT JOIN products p ON c.id = p.category_id
                WHERE c.id = ?
                GROUP BY c.id";
        
        $stmt = $this->db->query($sql, [$categoryId]);
        return $stmt->fetch();
    }

    public function getCategoryStats() {
        $sql = "SELECT c.*, 
                COUNT(p.id) as total_products,
                SUM(p.stock) as total_stock,
                AVG(p.price) as avg_price
                FROM categories c
                LEFT JOIN products p ON c.id = p.category_id
                GROUP BY c.id
                ORDER BY total_products DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
} 